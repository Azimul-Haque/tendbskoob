<?php

namespace App\Http\Controllers\Admin;

use Image;
use Carbon\Carbon;
use App\CPU\Helpers;
use App\Model\Brand;
use App\Model\Color;
use App\Model\Author;
use App\Model\Review;
use App\Model\Product;
use App\Model\Category;
use App\Model\Publisher;
use App\CPU\ImageManager;
use App\CPU\BackEndHelper;
use App\Model\Translation;
use App\Model\DealOfTheDay;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Model\FlashDealProduct;
use function App\CPU\translate;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;

use Rap2hpoutre\FastExcel\FastExcel;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;

class ProductController extends BaseController
{
    public function add_new()
    {
        $cat = Category::where(['parent_id' => 0])->get();
        $br = Brand::orderBY('name', 'ASC')->get();
        $publishers = Publisher::get();
        $authors = Author::get();
        return view('admin-views.product.add-new', compact('cat', 'br', 'publishers', 'authors'));
    }

    public function featured_status(Request $request)
    {
        $product = Product::find($request->id);
        $product->featured = ($product['featured'] == 0 || $product['featured'] == null) ? 1 : 0;
        $product->save();
        $data = $request->status;
        return response()->json($data);
    }
    
    public function stock_status(Request $request)
    {
        $product = Product::find($request->id);
        $product->stock_status = $request->stock_status;
        $product->save();
        $data = $request->stock_status;
        return response()->json($data);
    }

    public function approve_status(Request $request)
    {
        $product = Product::find($request->id);
        $product->request_status = ($product['request_status'] == 0) ? 1 : 0;
        $product->save();

        return redirect()->route('admin.product.list', ['seller', 'status' => $product['request_status']]);
    }

    public function deny(Request $request)
    {
        $product = Product::find($request->id);
        $product->request_status = 2;
        $product->denied_note = $request->denied_note;
        $product->save();

        return redirect()->route('admin.product.list', ['seller', 'status' => 2]);
    }

    public function view($id)
    {
        $product = Product::with(['reviews'])->where(['id' => $id])->first();
        $reviews = Review::where(['product_id' => $id])->paginate(Helpers::pagination_limit());

        // $authors = Author::get();
        // dd($authors[0]->products[0]->pivot);
        return view('admin-views.product.view', compact('product', 'reviews'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'publisher_id' => 'required',
            'name'         => 'required',
            'name_bangla'  => 'required',
            'category_id'  => 'required',
            // 'brand_id' => 'required',
            // 'unit' => 'required',
            // 'images' => 'required',
            'image'          => 'required',
            // 'tax'            => 'required|min:0',
            // 'purchase_price'  => 'required|numeric|min:1',
            // 'published_price' => 'required|numeric|min:1',
            // 'unit_price'      => 'required|numeric|min:1',
            'current_stock'   => 'required|numeric',
        ], [
            'publisher_id.required'    => 'Publication is required!',
            'name.required'            => 'English name is required!',
            'name_bangla.required'     => 'Bangla name is required!',
            'category_id.required'     => 'Category is required!',
            'image.required'           => 'Book image is required!',
            'purchase_price.required'  => 'Purchase Price is required!',
            'published_price.required' => 'Published Price is required!',
            'unit_price.required'      => 'Sale Price is required!',
            'current_stock.required'   => 'Total Quantity is required!',
            // 'brand_id.required' => 'brand  is required!',
            // 'unit.required' => 'Unit  is required!',
        ]);

        // if ($request['discount_type'] == 'percent') {
        //     $dis = ($request['unit_price'] / 100) * $request['discount'];
        // } else {
        //     $dis = $request['discount'];
        // }

        // if ($request['unit_price'] <= $dis) {
        //     $validator->after(function ($validator) {
        //         $validator->errors()->add(
        //             'unit_price', 'Discount can not be more or equal to the price!'
        //         );
        //     });
        // }
        // dd($request->all());
        $p              = new Product();
        $p->added_by    = "admin";
        $p->user_id     = auth('admin')->id();
        $p->name        = Str::slug($request->name) == '' ? $request->name : ucwords(str_replace('-', ' ', $request->name));
        $p->name_bangla = $request->name_bangla;
        $p->slug        = Str::slug($request->name, '-') . '-' . Helpers::random_number(5);
        if(Str::slug($request->name) == '') {
            $p->slug = Helpers::random_slug(15) . '-' . Helpers::random_number(5);
        }
        // dd($p->slug);
    
        $category = [];
        if($request->category_id) {
            foreach($request->category_id as $categoryid) {
                array_push($category, [
                    'id' => $categoryid,
                    'position' => 1,
                ]);
            }
        }
        // CATEGORY IDs ARE SYNCED LATER, AFTER SAVE
        // dd($category);
        // if ($request->category_id != null) {
        //     array_push($category, [
        //         'id' => $request->category_id,
        //         'position' => 1,
        //     ]);
        // }
        if ($request->sub_category_id != null) {
            array_push($category, [
                'id' => $request->sub_category_id,
                'position' => 2,
            ]);
        }
        if ($request->sub_sub_category_id != null) {
            array_push($category, [
                'id' => $request->sub_sub_category_id,
                'position' => 3,
            ]);
        }

        $p->category_ids = json_encode($category);
        $p->brand_id = $request->brand_id;
        $p->publisher_id = $request->publisher_id;
        // $p->unit = $request->unit;
        $p->isbn = $request->isbn;
        $p->weight = $request->weight ? $request->weight : 0;


        // if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
        //     $p->colors = json_encode($request->colors);
        // } else {
        //     $colors = [];
        //     $p->colors = json_encode($colors);
        // }
        // $choice_options = [];
        // if ($request->has('choice')) {
        //     foreach ($request->choice_no as $key => $no) {
        //         $str = 'choice_options_' . $no;
        //         $item['name'] = 'choice_' . $no;
        //         $item['title'] = $request->choice[$key];
        //         $item['options'] = explode(',', implode('|', $request[$str]));
        //         array_push($choice_options, $item);
        //     }
        // }
        // $p->choice_options = json_encode($choice_options);
        // //combinations start
        // $options = [];
        // if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
        //     $colors_active = 1;
        //     array_push($options, $request->colors);
        // }
        // if ($request->has('choice_no')) {
        //     foreach ($request->choice_no as $key => $no) {
        //         $name = 'choice_options_' . $no;
        //         $my_str = implode('|', $request[$name]);
        //         array_push($options, explode(',', $my_str));
        //     }
        // }
        //Generates the combinations of customer choice options
        
        // $combinations = Helpers::combinations($options);
        // $variations = [];
        // if (count($combinations[0]) > 0) {
        //     foreach ($combinations as $key => $combination) {
        //         $str = '';
        //         foreach ($combination as $k => $item) {
        //             if ($k > 0) {
        //                 $str .= '-' . str_replace(' ', '', $item);
        //             } else {
        //                 if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
        //                     $color_name = Color::where('code', $item)->first()->name;
        //                     $str .= $color_name;
        //                 } else {
        //                     $str .= str_replace(' ', '', $item);
        //                 }
        //             }
        //         }
        //         $item = [];
        //         $item['type'] = $str;
        //         $item['price'] = BackEndHelper::currency_to_usd(abs($request['price_' . str_replace('.', '_', $str)]));
        //         $item['sku'] = $request['sku_' . str_replace('.', '_', $str)];
        //         $item['qty'] = abs($request['qty_' . str_replace('.', '_', $str)]);
        //         array_push($variations, $item);
        //         $stock_count += $item['qty'];
        //     }
        // } else {
        //     $stock_count = (integer)$request['current_stock'];
        // }

        if ($validator->errors()->count() > 0) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }

        // if ($request->file('images')) {
        //     foreach ($request->file('images') as $img) {
        //         $product_images[] = ImageManager::upload('product/', 'png', $img);
        //     }
        //     $p->images = json_encode($product_images);
        // }
        // $p->thumbnail = ImageManager::upload('product/thumbnail/', 'png', $request->image);
        // $p->thumbnail = Image::make('product/thumbnail/');
        //combinations end
        $empty_array       = [];
        $p->colors         = json_encode($empty_array);
        $p->choice_options = json_encode($empty_array);
        $p->variation      = json_encode($empty_array);
        // $p->unit_price = BackEndHelper::currency_to_usd($request->unit_price);
        
        $p->purchase_price  = $request->purchase_price ? $request->purchase_price : 0;
        $p->published_price = $request->published_price ? $request->published_price : 0;
        $p->unit_price      = $request->unit_price ? $request->unit_price : 0;
        // $p->tax = $request->tax_type == 'flat' ? BackEndHelper::currency_to_usd($request->tax) : $request->tax;
        // $p->tax_type = $request->tax_type;
        // $p->discount = $request->discount_type == 'flat' ? BackEndHelper::currency_to_usd($request->discount) : $request->discount;
        // $p->discount_type = $request->discount_type;
        // $p->attributes = json_encode($request->choice_attributes);
        $stock_count      = (integer) $request['current_stock'];
        $p->current_stock = abs($stock_count);
        $p->details       = $request->description;


        // $p->video_provider = 'youtube';
        // $p->video_url = $request->video_link;
        if(auth('admin')->user()->role->name != 'Master Admin' && auth('admin')->user()->role->name != 'Admin') {
            $p->status = 0;
        }
        $p->request_status = 1; // status default to 1
        if($p->current_stock > 0) {
            $p->stock_status = $request->stock_status; // 1 = in stock, 2 = out of stock, 3 = back order
        } else {
            $p->stock_status = 2; // 1 = in stock, 2 = out of stock, 3 = back order
        }
        $p->meta_title = $request->bangla_name . '-' . $request->name;
        $p->meta_description = $request->description;
        // $p->meta_image = ImageManager::upload('product/meta/', 'png', $request->image);

        if ($request->ajax()) {
            return response()->json([], 200);
        } else {
            // to avoid the status 200 and uploading of image twice
            if($request->hasFile('image')) {
                $thumbnail = $request->file('image');
                // $filename  = Carbon::now()->toDateString() . "-" . uniqid() . "." . $thumbnail->getClientOriginalExtension();
                $filename  = Carbon::now()->toDateString() . "-" . uniqid() . ".jpg";
                $location1  = storage_path('app/public/product/thumbnail/'. $filename);
                $location2  = storage_path('app/public/product/meta/'. $filename);
                Image::make($thumbnail)
                     ->fit(260, 372)
                     ->insert(public_path('public/assets/back-end/img/watermark.png'), 'bottom-right', 10, 10)
                     ->text('www.booksbd.net', 30, 185, function($font) {
                        $font->file(public_path('public/fonts/Roboto-Black.ttf'));
                        $font->size(24);
                        $font->color(array(250, 250, 250, 0.25));
                        // $font->angle(45);
                    })->save($location1);
                Image::make($thumbnail)
                     ->fit(260, 372)
                     ->insert(public_path('public/assets/back-end/img/watermark.png'), 'bottom-right', 10, 10)
                     ->text('www.booksbd.net', 30, 185, function($font) {
                        $font->file(public_path('public/fonts/Roboto-Black.ttf'));
                        $font->size(24);
                        $font->color(array(250, 250, 250, 0.25));
                        // $font->angle(45);
                    })->save($location2);
                // dd($thumbnail);
                $p->thumbnail = $filename;
                $p->meta_image = $filename;
            }
            $p->save();

            // ATTACH CATEGORIES PUBLSHER...
            // foreach ($request->category_id as $key => $value) {
            //     $p->categories()->attach($value);
            // }
            $p->categories()->sync($request->category_id, false);
            
            
            // ATTACH AUTHORS WRITER...
            if($request->writer_id != null) {
                foreach ($request->writer_id as $key => $value) {
                    $p->writers()->attach([$value => ['author_type' => 1]]);
                }
            }
            
            // ATTACH AUTHORS TRANSLATOR...
            if($request->translator_id != null) {
                foreach ($request->translator_id as $key => $value) {
                    $p->translators()->attach([$value => ['author_type' => 2]]);
                }
            }
            
            // ATTACH AUTHORS EDITOR...
            if($request->editor_id != null) {
                foreach ($request->editor_id as $key => $value) {
                    $p->editors()->attach([$value => ['author_type' => 3]]);
                }
            }

            // $data = [];
            // foreach ($request->lang as $index => $key) {
            //     if ($request->name[$index] && $key != 'en') {
            //         array_push($data, array(
            //             'translationable_type' => 'App\Model\Product',
            //             'translationable_id' => $p->id,
            //             'locale' => $key,
            //             'key' => 'name',
            //             'value' => $request->name[$index],
            //         ));
            //     }
            //     if ($request->description[$index] && $key != 'en') {
            //         array_push($data, array(
            //             'translationable_type' => 'App\Model\Product',
            //             'translationable_id' => $p->id,
            //             'locale' => $key,
            //             'key' => 'description',
            //             'value' => $request->description[$index],
            //         ));
            //     }
            // }
            // Translation::insert($data);

            Toastr::success(translate('Product added successfully!'));
            return redirect()->route('admin.product.list', ['in_house']);
        }
    }

    function list(Request $request, $type)
    {
        $query_param = [];
        $search = $request['search'];
        $orderby = $request['orderby'] ? $request['orderby'] : 'asc';
        // dd($orderby);

        if ($type == 'in_house') {
            $pro = Product::where(['added_by' => 'admin']);
        } else {
            $pro = Product::where(['added_by' => 'seller'])->where('request_status', $request->status);
        }

        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $pro = $pro->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                    $q->orWhere('name_bangla', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        }
        $request_status = $request['status'];
        $pro = $pro->paginate(Helpers::pagination_limit())->appends(['status' => $request['status']])->appends($query_param);

        if($orderby == 'asc') {
            $pro->sortBy('publisher.name_bangla');
        } else {
            $pro->sortByDesc('publisher.name_bangla');
        }
        return view('admin-views.product.list', compact('pro', 'search', 'request_status', 'orderby'));
    }

    public function status_update(Request $request)
    {
        $product = Product::where(['id' => $request['id']])->first();
        $success = 1;
        if ($request['status'] == 1) {
            if ($product->added_by == 'seller' && $product->request_status == 0) {
                $success = 0;
            } else {
                $product->status = $request['status'];
            }
        } else {
            $product->status = $request['status'];
        }
        $product->save();
        return response()->json([
            'success' => $success,
        ], 200);
    }

    public function get_categories(Request $request)
    {
        $cat = Category::where(['parent_id' => $request->parent_id])->get();
        $res = '<option value="' . 0 . '" disabled selected>---Select---</option>';
        foreach ($cat as $row) {
            if ($row->id == $request->sub_category) {
                $res .= '<option value="' . $row->id . '" selected >' . $row->name . '</option>';
            } else {
                $res .= '<option value="' . $row->id . '">' . $row->name . '</option>';
            }
        }
        return response()->json([
            'select_tag' => $res,
        ]);
    }

    public function sku_combination(Request $request)
    {
        $options = [];
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $colors_active = 1;
            array_push($options, $request->colors);
        } else {
            $colors_active = 0;
        }

        $unit_price = $request->unit_price;
        $product_name = $request->name[array_search('en', $request->lang)];

        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_' . $no;
                $my_str = implode('', $request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }

        $combinations = Helpers::combinations($options);
        return response()->json([
            'view' => view('admin-views.product.partials._sku_combinations', compact('combinations', 'unit_price', 'colors_active', 'product_name'))->render(),
        ]);
    }

    public function edit($id)
    {
        $product = Product::withoutGlobalScopes()->with('translations')->find($id);
        $product_category = json_decode($product->category_ids);
        $product->colors = json_decode($product->colors);
        $cat = Category::where(['parent_id' => 0])->get();
        $br = Brand::orderBY('name', 'ASC')->get();
        $publishers = Publisher::get();
        $authors = Author::get();

        // dd($product->writers);

        return view('admin-views.product.edit', compact('cat', 'br', 'product', 'product_category', 'publishers', 'authors'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'publisher_id' => 'required',
            'name'         => 'required',
            'name_bangla'  => 'required',
            'category_id'  => 'required',
            'purchase_price'  => 'required|numeric|min:1',
            'published_price' => 'required|numeric|min:1',
            'unit_price'      => 'required|numeric|min:1',
            'current_stock'   => 'required|numeric',
        ], [
            'publisher_id.required'    => 'Publication is required!',
            'name.required'            => 'English name is required!',
            'name_bangla.required'     => 'Bangla name is required!',
            'category_id.required'     => 'Category is required!',
            'purchase_price.required'  => 'Purchase Price is required!',
            'published_price.required' => 'Published Price is required!',
            'unit_price.required'      => 'Sale Price is required!',
            'current_stock.required'   => 'Total Quantity is required!',
            // 'brand_id.required' => 'brand  is required!',
            // 'unit.required' => 'Unit  is required!',
        ]);
        
        $p = Product::find($id);
        $oldname = $p->name;
        $p->name        = Str::slug($request->name) == '' ? $request->name : ucwords(str_replace('-', ' ', $request->name));
        $p->name_bangla = $request->name_bangla;
        if($oldname != ucwords(str_replace('-', ' ', $request->name))) {
            $p->slug = Str::slug($request->name, '-') . '-' . Helpers::random_number(5);
            if(Str::slug($request->name) == '') {
                $p->slug = Helpers::random_slug(15) . '-' . Helpers::random_number(5);
            }
        }
        // dd($p->slug);
    
        $category = [];
        if($request->category_id) {
            foreach($request->category_id as $categoryid) {
                array_push($category, [
                    'id' => $categoryid,
                    'position' => 1,
                ]);
            }
        }
        // CATEGORY IDs ARE SYNCED LATER, AFTER SAVE

        if ($request->sub_category_id != null) {
            array_push($category, [
                'id' => $request->sub_category_id,
                'position' => 2,
            ]);
        }
        if ($request->sub_sub_category_id != null) {
            array_push($category, [
                'id' => $request->sub_sub_category_id,
                'position' => 3,
            ]);
        }

        $p->category_ids = json_encode($category);
        $p->brand_id = $request->brand_id;
        $p->publisher_id = $request->publisher_id;
        // $p->unit = $request->unit;
        $p->isbn = $request->isbn;
        $p->weight = $request->weight ? $request->weight : 0;

        if ($validator->errors()->count() > 0) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
        
        $p->purchase_price  = $request->purchase_price;
        $p->published_price = $request->published_price;
        $p->unit_price      = $request->unit_price;
        $stock_count      = (integer) $request['current_stock'];
        $p->current_stock = abs($stock_count);
        $p->details       = $request->description;

        $p->request_status = 1; // status default to 1
        if($p->current_stock > 0) {
            $p->stock_status = $request->stock_status; // 1 = in stock, 2 = out of stock, 3 = back order
        } else {
            $p->stock_status = 2; // 1 = in stock, 2 = out of stock, 3 = back order
        }
        $p->meta_title = $request->bangla_name . '-' . $request->name;
        $p->meta_description = $request->description;

        if ($request->ajax()) {
            return response()->json([], 200);
        } else {
            // to avoid the status 200 and uploading of image twice
            if($request->hasFile('image')) {
                $image_path1 = storage_path('app/public/product/thumbnail/'. $p->thumbnail);
                if(File::exists($image_path1)) {
                    File::delete($image_path1);
                }
                $image_path2 = storage_path('app/public/product/meta/'. $p->meta_image);
                if(File::exists($image_path2)) {
                    File::delete($image_path2);
                }
                $thumbnail = $request->file('image');
                // $filename  = Carbon::now()->toDateString() . "-" . uniqid() . "." . $thumbnail->getClientOriginalExtension();
                $filename  = Carbon::now()->toDateString() . "-" . uniqid() . ".jpg";
                $location1  = storage_path('app/public/product/thumbnail/'. $filename);
                $location2  = storage_path('app/public/product/meta/'. $filename);
                Image::make($thumbnail)
                     ->fit(260, 372)
                     ->insert(public_path('public/assets/back-end/img/watermark.png'), 'bottom-right', 10, 10)
                     ->text('www.booksbd.net', 30, 185, function($font) {
                        $font->file(public_path('public/fonts/Roboto-Black.ttf'));
                        $font->size(24);
                        $font->color(array(250, 250, 250, 0.25));
                        // $font->angle(45);
                    })->save($location1);
                Image::make($thumbnail)
                     ->fit(260, 372)
                     ->insert(public_path('public/assets/back-end/img/watermark.png'), 'bottom-right', 10, 10)
                     ->text('www.booksbd.net', 30, 185, function($font) {
                        $font->file(public_path('public/fonts/Roboto-Black.ttf'));
                        $font->size(24);
                        $font->color(array(250, 250, 250, 0.25));
                        // $font->angle(45);
                    })->save($location2);
                // dd($thumbnail);
                $p->thumbnail = $filename;
                $p->meta_image = $filename;
            }
            $p->save();

            // ATTACH CATEGORIES PUBLSHER...
            // foreach ($request->category_id as $key => $value) {
            //     $p->categories()->attach($value);
            // }
            $p->categories()->detach();
            $p->categories()->sync($request->category_id, false);
            
            // ATTACH AUTHORS WRITER...
            $p->writers()->detach();
            if($request->writer_id != null) {
                foreach ($request->writer_id as $key => $value) {
                    $p->writers()->attach([$value => ['author_type' => 1]]);
                }
            }
            
            // ATTACH AUTHORS TRANSLATOR...
            $p->translators()->detach();
            if($request->translator_id != null) {
                foreach ($request->translator_id as $key => $value) {
                    $p->translators()->attach([$value => ['author_type' => 2]]);
                }
            }
            
            // ATTACH AUTHORS EDITOR...
            $p->editors()->detach();
            if($request->editor_id != null) {
                foreach ($request->editor_id as $key => $value) {
                    $p->editors()->attach([$value => ['author_type' => 3]]);
                }
            }

            Toastr::success(translate('Product updated successfully!'));
            return redirect()->route('admin.product.list', ['in_house']);
        }
    }

    public function remove_image(Request $request)
    {
        ImageManager::delete('/product/' . $request['image']);
        $product = Product::find($request['id']);
        $array = [];
        if (count(json_decode($product['images'])) < 2) {
            Toastr::warning('You cannot delete all images!');
            return back();
        }
        foreach (json_decode($product['images']) as $image) {
            if ($image != $request['name']) {
                array_push($array, $image);
            }
        }
        Product::where('id', $request['id'])->update([
            'images' => json_encode($array),
        ]);
        Toastr::success('Product image removed successfully!');
        return back();
    }

    public function delete($id)
    {
        $translation = Translation::where('translationable_type', 'App\Model\Product')
            ->where('translationable_id', $id);
        $translation->delete();
        $product = Product::find($id);
        // foreach (json_decode($product['images'], true) as $image) {
        //     ImageManager::delete('/product/' . $image);
        // }
        ImageManager::delete('/product/thumbnail/' . $product['thumbnail']);
        $product->delete();
        FlashDealProduct::where(['product_id' => $id])->delete();
        DealOfTheDay::where(['product_id' => $id])->delete();
        Toastr::success('Product removed successfully!');
        return back();
    }

    public function bulk_import_index()
    {
        return view('admin-views.product.bulk-import');
    }

    public function bulk_import_data(Request $request)
    {
        try {
            $collections = (new FastExcel)->import($request->file('products_file'));
        } catch (\Exception $exception) {
            Toastr::error('You have uploaded a wrong format file, please upload the right file.');
            return back();
        }

        $data = [];
        // $skip = ['youtube_video_url', 'details'];
        foreach ($collections as $collection) 
        {            
            $p              = new Product();
            $p->added_by    = "admin";
            $p->user_id     = auth('admin')->id();
            $p->name        = Str::slug($collection['name']) == '' ? $collection['name'] : ucwords(str_replace('-', ' ', $collection['name']));
            $p->name_bangla = $collection['name_bangla'];
            $p->slug        = Str::slug($collection['name'], '-') . '-' . Helpers::random_number(5);
            if(Str::slug($collection['name']) == '') {
                $p->slug = Helpers::random_slug(15) . '-' . Helpers::random_number(5);
            }
            // dd($p->slug);
    
            $category = [];
            $category_array = explode(',', $collection['category_id']);
            
            if($collection['category_id']) {
                foreach($category_array as $categoryid) {
                    array_push($category, [
                        'id' => $categoryid,
                        'position' => 1,
                    ]);
                }
            }
            // CATEGORY IDs ARE SYNCED LATER, AFTER SAVE

            $p->category_ids = json_encode($category);
            $p->publisher_id = $collection['publisher_id'];
            $p->isbn         = $collection['isbn'];
            $p->weight       = $collection['weight'] ? $collection['weight'] : 0;

            $empty_array       = [];
            $p->colors         = json_encode($empty_array);
            $p->choice_options = json_encode($empty_array);
            $p->variation      = json_encode($empty_array);
        
            $p->purchase_price   = $collection['purchase_price'];
            $p->published_price  = $collection['published_price'];
            $p->unit_price       = $collection['sale_price'];
            $stock_count         = (integer) $collection['current_stock'];
            $p->current_stock    = abs($stock_count);
            $p->details          = $collection['description'];
            $p->request_status   = 1; // status default to 1
            if($p->current_stock > 0) {
                $p->stock_status = $collection['stock_status']; // 1 = in stock, 2 = out of stock, 3 = back order
            } else {
                $p->stock_status = 2; // 1 = in stock, 2 = out of stock, 3 = back order
            }                             // in stock, 2 = out of stock, 3 = back order
            $p->meta_title       = $collection['name_bangla'] . '-' . $collection['name'];
            $p->meta_description = $collection['description'];

            $p->save();

            // ATTACH CATEGORIES PUBLSHER...
            $p->categories()->sync($category_array, false);
        
            // ATTACH AUTHORS WRITER...
            if($collection['writer_id'] != null) {
                $writer_array = explode(',', $collection['writer_id']);
                foreach ($writer_array as $key => $value) {
                    $p->writers()->attach([$value => ['author_type' => 1]]);
                }
            }
            
            // ATTACH AUTHORS TRANSLATOR...
            if($collection['translator_id'] != null) {
                $translator_array = explode(',', $collection['translator_id']);
                foreach ($translator_array as $key => $value) {
                    $p->translators()->attach([$value => ['author_type' => 2]]);
                }
            }
            
            // ATTACH AUTHORS EDITOR...
            if($collection['translator_id'] != null) {
                $editor_array = explode(',', $collection['translator_id']);
                foreach ($editor_array as $key => $value) {
                    $p->editors()->attach([$value => ['author_type' => 3]]);
                }
            }

            // array_push($data, [
            //     'publisher_id' => $collection['publisher_id'],
            //     'name_bangla' => $collection['name_bangla'],
            //     'name' => $collection['name'],
            //     'slug' => Str::slug($collection['name'], '-') . '-' . Str::random(6),
            //     'category_ids' => json_encode([['id' => $collection['category_id'], 'position' => 0], ['id' => $collection['sub_category_id'], 'position' => 1], ['id' => $collection['sub_sub_category_id'], 'position' => 2]]),
            //     'brand_id' => $collection['brand_id'],
            //     'unit' => $collection['unit'],
            //     'min_qty' => $collection['min_qty'],
            //     'refundable' => $collection['refundable'],
            //     'unit_price' => $collection['unit_price'],
            //     'purchase_price' => $collection['purchase_price'],
            //     'tax' => $collection['tax'],
            //     'discount' => $collection['discount'],
            //     'discount_type' => $collection['discount_type'],
            //     'current_stock' => $collection['current_stock'],
            //     'details' => $collection['details'],
            //     'video_provider' => 'youtube',
            //     'video_url' => $collection['youtube_video_url'],
            //     'images' => json_encode(['def.png']),
            //     'thumbnail' => 'def.png',
            //     'status' => 1,
            //     'request_status' => 1,
            //     'colors' => json_encode([]),
            //     'attributes' => json_encode([]),
            //     'choice_options' => json_encode([]),
            //     'variation' => json_encode([]),
            //     'featured_status' => 1,
            //     'added_by' => 'admin',
            //     'user_id' => auth('admin')->id(),
            // ]);
        }
        // DB::table('products')->insert($data);
        // Toastr::success(count($data) . ' - Products imported successfully!');
        // return back();

        Toastr::success(translate('Products imported successfully!'));
        return redirect()->route('admin.product.list', ['in_house']);
    }

    public function bulk_export_data()
    {
        $products = Product::where(['added_by' => 'admin'])->get();
        //export from product
        $storage = [];
        foreach ($products as $product)
        {   
            $writer_ids = '';
            $writer_ids_array = [];
            if($product->writers) {
                foreach ($product->writers as $writer) {
                    $writer_ids_array[] = $writer->id;
                }
                $writer_ids = implode(",", $writer_ids_array);
            }
            
            $translator_ids = '';
            $translator_ids_array = [];
            if($product->translators) {
                foreach ($product->translators as $translator) {
                    $translator_ids_array[] = $translator->id;
                }
                $translator_ids = implode(",", $translator_ids_array);
            }
            
            $editor_ids = '';
            $editor_ids_array = [];
            if($product->editors) {
                foreach ($product->editors as $editor) {
                    $editor_ids_array[] = $editor->id;
                }
                $editor_ids = implode(",", $editor_ids_array);
            }
            
            $category_ids = '';
            $category_ids_array = [];
            foreach (json_decode($product->category_ids, true) as $category) {
                if ($category['position'] == 1) {
                    $category_ids_array[] = $category['id'];
                }
                $category_ids = implode(",", $category_ids_array);
            }
            // dd($category_ids);

            $storage[] = [
                'publisher_id'    => $product->name,
                'name_bangla'     => $product->name_bangla,
                'name'            => $product->name,
                'writer_id'       => $writer_ids,
                'translator_id'   => $translator_ids,
                'editor_id'       => $editor_ids,
                'category_id'     => $category_ids,
                'description'     => $product->details,
                'isbn'            => $product->isbn,
                'weight'          => $product->weight,
                'purchase_price'  => $product->purchase_price,
                'published_price' => $product->published_price,
                'sale_price'      => $product->unit_price,
                'current_stock'   => $product->current_stock,
                'stock_status'    => $product->stock_status,                
            ];
        }
        return (new FastExcel($storage))->download('inhouse_products.xlsx');
    }
}
