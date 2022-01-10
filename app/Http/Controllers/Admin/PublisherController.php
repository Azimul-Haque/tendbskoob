<?php

namespace App\Http\Controllers\Admin;

use Excel;
use Image;
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
use App\Imports\PublisherImport;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Filesystem\Filesystem;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;

class PublisherController extends BaseController
{
    public function index(Request $request)
    {
        $query_param = [];
        $search  = $request['search'];
        $orderby = $request['orderby'] ? $request['orderby'] : 'asc';
        // dd($orderby);

        if($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $publishers = Publisher::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                    $q->orWhere('name_bangla', 'like', "%{$value}%");
                }
            })->orderBy('name_bangla', $orderby)->paginate(12);
            $query_param = ['search' => $request['search']];
        }else{
            $publishers = Publisher::orderBy('name_bangla', $orderby)->paginate(12);
        }

        $publishers->appends($query_param);
        $totalpublishers = Publisher::get()->count();

        return view('admin-views.publisher.index')
                        ->withPublishers($publishers)
                        ->withTotalpublishers($totalpublishers)
                        ->withSearch($search)
                        ->withOrderby($orderby);
    }

    public function store(Request $request)
    {
        $request->validate([
             
            'name_bangla' => 'required',
            'image'       => 'sometimes',
            'description' => 'sometimes'
        ], [
            'name.required' => 'Publisher name is required!',
        ]);

        $publisher              = new Publisher();
        $publisher->name        = Str::slug($request->name) == '' ? $request->name : ucwords(str_replace('-', ' ', $request->name));
        $publisher->name_bangla = $request->name_bangla;
        $publisher->slug        = Helpers::random_number(10). '-' . Str::slug($request->name);
        if(Str::slug($request->name) == '') {
            $publisher->slug = Helpers::random_slug(15) . '-' . Helpers::random_number(5);
        }
        // dd($publisher->slug);
        // $publisher->icon = ImageManager::upload('publisher/', 'png', $request->file('image'));
        if($request->hasFile('image')) {
            $image    = $request->file('image');
            // $filename = Helpers::random_slug(10) . '.' . $image->getClientOriginalExtension();
            $filename = Helpers::random_slug(10) . '.jpg';
            $location = public_path('/public/images/publisher/'. $filename);
            Image::make($image)->resize(200, 200)->save($location);
            $publisher->image = $filename;
            // $publisher->image = ImageManager::upload('publisher/', 'png', $request->file('image'));
        }
        $publisher->description = $request->description;
        $publisher->save();

        Toastr::success('Publisher added successfully!');
        return redirect()->route('admin.publisher.index');
    }

    public function edit($id)
    {
        $publisher = Publisher::withoutGlobalScopes()->find($id);
        // dd($publisher);
        return view('admin-views.publisher.edit', compact('publisher'));
    }

    public function update($id, Request $request)
    {
        $publisher = Publisher::find($request->id);
        $oldname = $publisher->name;
        $publisher->name        = Str::slug($request->name) == '' ? $request->name : ucwords(str_replace('-', ' ', $request->name));
        $publisher->name_bangla = $request->name_bangla;
        if($oldname != ucwords(str_replace('-', ' ', $request->name))) {
            $publisher->slug        = Helpers::random_number(10). '-' . Str::slug($request->name);
            if(Str::slug($request->name) == '') {
                $publisher->slug = Helpers::random_slug(15) . '-' . Helpers::random_number(5);
            }
        }
        if($request->hasFile('image')) {
            $image_path = public_path('/public/images/publisher/'. $publisher->image);
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $image    = $request->file('image');
            // $filename = Helpers::random_slug(10) . '.' . $image->getClientOriginalExtension();
            $filename = Helpers::random_slug(10) . '.jpg';
            $location = public_path('/public/images/publisher/'. $filename);
            Image::make($image)->resize(200, 200)->save($location);
            $publisher->image = $filename;
            // $publisher->image = ImageManager::upload('publisher/', 'png', $request->file('image'));
        }
        $publisher->description = $request->description;
        $publisher->save();

        Toastr::success('Publisher updated successfully!');
        return redirect()->route('admin.publisher.index');
    }

    public function delete(Request $request)
    {
        $publisher = Publisher::find($request->id);
        $image_path = public_path('/public/images/publisher/'. $publisher->image);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        // dd($image_path);
        $publisher->delete();
        Toastr::success('Publisher removed successfully!');
        return redirect()->route('admin.publisher.index');
    }

    public function bulkUpload(Request $request)
    {
        $request->validate([
            'excelfile' => 'required'
        ], [
            'excelfile.required' => 'An Excel file is required!',
        ]);

        try {
          $file= $request->file('excelfile')->store('import');
          $import = new PublisherImport;
          $import->import($file);
          if($import->failures()->count() > 0) {
            //   dd($import->failures());
              Toastr::info('Publications from Excel File added successfully!<br>' . $import->failures()->count() . ' duplicate entries skipped.');
          } else {
            Toastr::success('Publications from Excel File added successfully!');
          }
        } catch (\Exception $e) {
            // return $e->getMessage();
            Toastr::warning('Error! Try with correct format.<br><small>' .$e->getMessage() . '</small>');
        }

        // unlink(storage_path('app/'.$file));
        $deletefile = new Filesystem;
        $deletefile->cleanDirectory(storage_path('app/import'));
        $deletefile->cleanDirectory(storage_path('debugbar'));
        return redirect()->route('admin.publisher.index');
    }
}
