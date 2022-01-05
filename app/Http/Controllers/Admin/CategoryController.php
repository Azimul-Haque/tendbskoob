<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\CPU\Helpers;
use App\Model\Category;
use App\CPU\ImageManager;
use App\Model\Translation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Imports\CategoryImport;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        $orderby = $request['orderby'] ? $request['orderby'] : 'asc';
        // dd($orderby);
        if($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $categories = Category::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                    $q->orWhere('name_bangla', 'like', "%{$value}%");
                }
            })->orderBy('name_bangla', $orderby);
            $query_param = ['search' => $request['search'], 'orderby' => $orderby];
        }else{
            $categories = Category::where(['position' => 0])->orderBy('name_bangla', $orderby);
        }

        $categories = $categories->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('admin-views.category.view', compact('categories','search', 'orderby'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'name_bangla' => 'required',
            'image'       => 'sometimes'
        ], [
            'name.required'  => 'Category name is required!',
            'name_bangla.required'  => 'Category name in Bangla is required!',
            // 'image.required' => 'Category image is required!',
        ]);

        $category              = new Category;
        $category->name        = Str::slug($request->name) == '' ? $request->name : ucwords(str_replace('-', ' ', $request->name));
        $category->name_bangla = $request->name_bangla;
        $category->slug        = Helpers::random_number(10). '-' . Str::slug($request->name);
        if(Str::slug($request->name) == '') {
            $category->slug = Helpers::random_slug(15) . '-' . Helpers::random_number(5);
        }
        // $category->icon        = ImageManager::upload('category/', 'png', $request->file('image'));
        if($request->hasFile('image')) {
            $image    = $request->file('image');
            // $filename = Helpers::random_slug(10) . '.' . $image->getClientOriginalExtension();
            $filename = Helpers::random_slug(10) . '.jpg';
            $location = public_path('/public/images/category/'. $filename);
            Image::make($image)->fit(300, 100)->save($location);
            $category->icon = $filename;
            // $publisher->image = ImageManager::upload('publisher/', 'png', $request->file('image'));
        }
        $category->parent_id   = 0;
        $category->position    = 0;
        // $category->home_status = 1;
        $category->save();

        // $data = [];
        // foreach ($request->lang as $index => $key) {
        //     if ($request->name[$index] && $key != 'en') {
        //         array_push($data, array(
        //             'translationable_type' => 'App\Model\Category',
        //             'translationable_id'   => $category->id,
        //             'locale'               => $key,
        //             'key'                  => 'name',
        //             'value'                => $request->name[$index],
        //         ));
        //     }
        // }
        // if (count($data)) {
        //     Translation::insert($data);
        // }

        Toastr::success('Category added successfully!');
        return back();
    }

    public function edit(Request $request, $id)
    {
        $category = category::withoutGlobalScopes()->find($id);
        return view('admin-views.category.category-edit', compact('category'));
    }

    public function update(Request $request)
    {
        $category = Category::find($request->id);
        $oldname = $category->name;
        $category->name        = Str::slug($request->name) == '' ? $request->name : ucwords(str_replace('-', ' ', $request->name));
        $category->name_bangla = $request->name_bangla;
        if($oldname != ucwords(str_replace('-', ' ', $request->name))) {
            $category->slug        = Helpers::random_number(10). '-' . Str::slug($request->name);
            if(Str::slug($request->name) == '') {
                $category->slug = Helpers::random_slug(15) . '-' . Helpers::random_number(5);
            }
        }
        // if ($request->image) {
        //     $category->icon = ImageManager::update('category/', $category->icon, 'png', $request->file('image'));
        // }
        if($request->hasFile('image')) {
            $image_path = public_path('/public/images/category/'. $category->icon);
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $image    = $request->file('image');
            // $filename = Helpers::random_slug(10) . '.' . $image->getClientOriginalExtension();
            $filename = Helpers::random_slug(10) . '.jpg';
            $location = public_path('/public/images/category/'. $filename);
            Image::make($image)->fit(300, 100)->save($location);
            $category->icon = $filename;
            // $publisher->image = ImageManager::upload('publisher/', 'png', $request->file('image'));
        }
        $category->save();

        // foreach ($request->lang as $index => $key) {
        //     if ($request->name[$index] && $key != 'en') {
        //         Translation::updateOrInsert(
        //             ['translationable_type' => 'App\Model\Category',
        //                 'translationable_id' => $category->id,
        //                 'locale' => $key,
        //                 'key' => 'name'],
        //             ['value' => $request->name[$index]]
        //         );
        //     }
        // }

        Toastr::success('Category updated successfully!');
        return redirect()->route('admin.category.view');
    }

    public function delete(Request $request)
    {
        $categories = Category::where('parent_id', $request->id)->get();
        // dd($categories);
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $categories1 = Category::where('parent_id', $category->id)->get();
                if (!empty($categories1)) {
                    foreach ($categories1 as $category1) {
                        $translation = Translation::where('translationable_type','App\Model\Category')
                                    ->where('translationable_id',$category1->id);
                        $translation->delete();
                        Category::destroy($category1->id);

                    }
                }
                $translation = Translation::where('translationable_type','App\Model\Category')
                                    ->where('translationable_id',$category->id);
                $translation->delete();
                Category::destroy($category->id);

            }
        }
        $translation = Translation::where('translationable_type','App\Model\Category')
                                    ->where('translationable_id',$request->id);
        $translation->delete();

        $finalcategory = Category::findOrFail($request->id);
        $image_path = public_path('/public/images/category/'. $finalcategory->icon);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        Category::destroy($request->id);

        return response()->json();
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::where('position', 0)->orderBy('id', 'desc')->get();
            return response()->json($data);
        }
    }

    public function status(Request $request)
    {
        $category = Category::find($request->id);
        $category->home_status = $request->home_status;
        $category->save();
        Toastr::success('Service status updated!');
        return back();
    }

    public function bulkUpload(Request $request)
    {
        $request->validate([
            'excelfile' => 'required'
        ], [
            'excelfile.required' => 'An Excel file is required!',
        ]);

        $file= $request->file('excelfile')->store('import');
        $import = new CategoryImport;
        $import->import($file);
        if($import->failures()->count() > 0) {
        //   dd($import->failures());
            Toastr::info('Categories from Excel File added successfully!<br>' . $import->failures()->count() . ' duplicate entries skipped.');
        } else {
        Toastr::success('Categories from Excel File added successfully!');
        }
        try {
          
        } catch (\Exception $e) {
            return $e->getMessage();
            Toastr::warning('Error! Try with correct format.<br><small>' .$e->getMessage() . '</small>');
        }

        // unlink(storage_path('app/'.$file));
        $deletefile = new Filesystem;
        $deletefile->cleanDirectory(storage_path('app/import'));
        $deletefile->cleanDirectory(storage_path('debugbar'));
        return redirect()->route('admin.category.view');
    }
}
