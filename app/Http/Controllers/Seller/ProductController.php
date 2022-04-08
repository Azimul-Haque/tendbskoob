<?php

namespace App\Http\Controllers\Seller;

use Image;
use Carbon\Carbon;
use App\CPU\BackEndHelper;
use App\CPU\Convert;
use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Seller;
use App\Model\Category;
use App\Model\Publisher;
use App\Model\Author;
use App\Model\Color;
use App\Model\DealOfTheDay;
use App\Model\FlashDealProduct;
use App\Model\Product;
use App\Model\Review;
use App\Model\Translation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Rap2hpoutre\FastExcel\FastExcel;

class ProductController extends Controller
{
    public function add_new()
    {
        $cat = Category::where(['parent_id' => 0])->get();
        $br = Brand::orderBY('name', 'ASC')->get();
        $publishers = Publisher::get();
        $authors = Author::get();
        $seller = Seller::findOrFail(auth('seller')->id());
        return view('seller-views.product.add-new', compact('cat', 'br', 'publishers', 'authors', 'seller'));
    }

    public function status_update(Request $request)
    {
        if ($request['status'] == 0) {
            Product::where(['id' => $request['id'], 'added_by' => 'seller', 'user_id' => \auth('seller')->id()])->update([
                'status' => $request['status'],
            ]);
            return response()->json([
                'success' => 1,
            ], 200);
        } elseif ($request['status'] == 1) {
            if (Product::find($request['id'])->request_status == 1) {
                Product::where(['id' => $request['id']])->update([
                    'status' => $request['status'],
                ]);
                return response()->json([
                    'success' => 1,
                ], 200);
            } else {
                return response()->json([
                    'success' => 0,
                ], 200);
            }
        }
    }

    public function featured_status(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::find($request->id);
            $product->featured_status = $request->status;
            $product->save();
            $data = $request->status;
            return response()->json($data);
        }
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'publisher_id' => 'required',
            'name'         => 'required',
            'name_bangla'  => 'required',
            'category_id'  => 'required',
 
            'image'          => 'required',

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

        ]);

        $p              = new Product();
        $p->user_id = auth('seller')->id();
        $p->added_by = "seller";
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

        if ($validator->errors()->count() > 0) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }

        $empty_array       = [];
        $p->colors         = json_encode($empty_array);
        $p->choice_options = json_encode($empty_array);
        $p->variation      = json_encode($empty_array);
        // $p->unit_price = BackEndHelper::currency_to_usd($request->unit_price);
        
        $p->purchase_price  = $request->purchase_price ? $request->purchase_price : 0;
        $p->published_price = $request->published_price ? $request->published_price : 0;
        $p->unit_price      = $request->unit_price ? $request->unit_price : 0;
        
        $stock_count      = (integer) $request['current_stock'];
        $p->current_stock = abs($stock_count);
        $p->details       = $request->description;


        // $p->video_provider = 'youtube';
        // $p->video_url = $request->video_link;
        $p->status = 0; // boi deha jaabe ki na store e, eta diye set hoy
        $p->request_status = 0; // status default to 0 for seller
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
                    //  ->insert(public_path('public/assets/back-end/img/watermark.png'), 'bottom-right', 10, 10)
                     ->text('www.booksbd.net', 20, 185, function($font) {
                        $font->file(public_path('public/fonts/Roboto-Black.ttf'));
                        $font->size(26);
                        $font->color(array(250, 250, 250, 0.30));
                        // $font->angle(45);
                    })->save($location1);
                Image::make($thumbnail)
                     ->fit(260, 372)
                    //  ->insert(public_path('public/assets/back-end/img/watermark.png'), 'bottom-right', 10, 10)
                     ->text('www.booksbd.net', 20, 185, function($font) {
                        $font->file(public_path('public/fonts/Roboto-Black.ttf'));
                        $font->size(26);
                        $font->color(array(250, 250, 250, 0.30));
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

            Toastr::success('Product added successfully!');
            return redirect()->route('seller.product.list');
        }
    }

    function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        $orderby = $request['orderby'] ? $request['orderby'] : 'asc';

        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $pro = Product::where(['added_by' => 'seller', 'user_id' => \auth('seller')->id()])
                ->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->Where('name', 'like', "%{$value}%");
                    }
                });
            $query_param = ['search' => $request['search']];
        } else {
            $pro = Product::where(['added_by' => 'seller', 'user_id' => \auth('seller')->id()]);
        }
        $pro = $pro->orderBy('id', 'DESC')->paginate(Helpers::pagination_limit())->appends($query_param);

        if($orderby == 'asc') {
            $pro->sortBy('publisher.name_bangla');
        } else {
            $pro->sortByDesc('publisher.name_bangla');
        }
        return view('seller-views.product.list', compact('pro', 'search', 'orderby'));
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
        $categories = Category::where(['parent_id' => 0])->get();
        $br = Brand::orderBY('name', 'ASC')->get();
        return view('seller-views.product.edit', compact('categories', 'br', 'product', 'product_category'));

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'publisher_id' => 'required',
            'name'         => 'required',
            'name_bangla'  => 'required',
            'category_id'  => 'required',
            // 'purchase_price'  => 'required|numeric|min:1',
            // 'published_price' => 'required|numeric|min:1',
            // 'unit_price'      => 'required|numeric|min:1',
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
        
        $p->purchase_price  = $request->purchase_price ? $request->purchase_price : $p->purchase_price;
        $p->published_price = $request->published_price ? $request->published_price : $p->published_price;
        $p->unit_price      = $request->unit_price ? $request->unit_price : $p->unit_price;
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
                    //  ->insert(public_path('public/assets/back-end/img/watermark.png'), 'bottom-right', 10, 10)
                     ->text('www.booksbd.net', 20, 185, function($font) {
                        $font->file(public_path('public/fonts/Roboto-Black.ttf'));
                        $font->size(26);
                        $font->color(array(250, 250, 250, 0.30));
                        // $font->angle(45);
                    })->save($location1);
                Image::make($thumbnail)
                     ->fit(260, 372)
                    //  ->insert(public_path('public/assets/back-end/img/watermark.png'), 'bottom-right', 10, 10)
                     ->text('www.booksbd.net', 20, 185, function($font) {
                        $font->file(public_path('public/fonts/Roboto-Black.ttf'));
                        $font->size(26);
                        $font->color(array(250, 250, 250, 0.30));
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

            Toastr::success('Product updated successfully!');
            return redirect()->route('seller.product.list', ['in_house']);
        }
    }

    public function view($id)
    {
        $product = Product::with(['reviews'])->where(['id' => $id])->first();
        $reviews = Review::where(['product_id' => $id])->paginate(Helpers::pagination_limit());
        return view('seller-views.product.view', compact('product', 'reviews'));
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
        $product = Product::find($id);
        foreach (json_decode($product['images'], true) as $image) {
            ImageManager::delete('/product/' . $image);
        }
        ImageManager::delete('/product/thumbnail/' . $product['thumbnail']);
        $product->delete();
        FlashDealProduct::where(['product_id' => $id])->delete();
        DealOfTheDay::where(['product_id' => $id])->delete();
        Toastr::success('Product removed successfully!');
        return back();
    }

    public function bulk_import_index()
    {
        return view('seller-views.product.bulk-import');
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
        $skip = ['youtube_video_url', 'details'];
        foreach ($collections as $collection) {
            foreach ($collection as $key => $value) {
                if ($value === "" && !in_array($key, $skip)) {
                    Toastr::error('Please fill ' . $key . ' fields');
                    return back();
                }
            }

            array_push($data, [
                'name' => $collection['name'],
                'slug' => Str::slug($collection['name'], '-') . '-' . Str::random(6),
                'category_ids' => json_encode([['id' => $collection['category_id'], 'position' => 0], ['id' => $collection['sub_category_id'], 'position' => 1]]),
                'brand_id' => $collection['brand_id'],
                'unit' => $collection['unit'],
                'min_qty' => $collection['min_qty'],
                'refundable' => $collection['refundable'],
                'unit_price' => $collection['unit_price'],
                'purchase_price' => $collection['purchase_price'],
                'tax' => $collection['tax'],
                'discount' => $collection['discount'],
                'discount_type' => $collection['discount_type'],
                'current_stock' => $collection['current_stock'],
                'details' => $collection['details'],
                'video_provider' => 'youtube',
                'video_url' => $collection['youtube_video_url'],
                'images' => json_encode(['def.png']),
                'thumbnail' => 'def.png',
                'status' => 0,
                'colors' => json_encode([]),
                'attributes' => json_encode([]),
                'choice_options' => json_encode([]),
                'variation' => json_encode([]),
                'featured_status' => 1,
                'added_by' => 'seller',
                'user_id' => auth('seller')->id(),
            ]);
        }
        DB::table('products')->insert($data);
        Toastr::success(count($data) . ' - Products imported successfully!');
        return back();
    }

    public function bulk_export_data()
    {
        $products = Product::where(['added_by' => 'seller', 'user_id' => \auth('seller')->id()])->get();
        //export from product
        $storage = [];
        foreach ($products as $item) {
            $category_id = 0;
            $sub_category_id = 0;
            $sub_sub_category_id = 0;
            foreach (json_decode($item->category_ids, true) as $category) {
                if ($category['position'] == 1) {
                    $category_id = $category['id'];
                } else if ($category['position'] == 2) {
                    $sub_category_id = $category['id'];
                } else if ($category['position'] == 3) {
                    $sub_sub_category_id = $category['id'];
                }
            }
            $storage[] = [
                'name' => $item->name,
                'category_id' => $category_id,
                'sub_category_id' => $sub_category_id,
                'sub_sub_category_id' => $sub_sub_category_id,
                'brand_id' => $item->brand_id,
                'unit' => $item->unit,
                'min_qty' => $item->min_qty,
                'refundable' => $item->refundable,
                'youtube_video_url' => $item->video_url,
                'unit_price' => $item->unit_price,
                'purchase_price' => $item->purchase_price,
                'tax' => $item->tax,
                'discount' => $item->discount,
                'discount_type' => $item->discount_type,
                'current_stock' => $item->current_stock,
                'details' => $item->details,

            ];
        }
        return (new FastExcel($storage))->download('products.xlsx');
    }
}
