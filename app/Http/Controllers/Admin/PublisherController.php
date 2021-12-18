<?php

namespace App\Http\Controllers\Admin;

use App\CPU\BackEndHelper;
use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\BaseController;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Color;
use App\Model\DealOfTheDay;
use App\Model\FlashDealProduct;
use App\Model\Product;
use App\Model\Author;
use App\Model\Publisher;
use App\Model\Review;
use App\Model\Translation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Rap2hpoutre\FastExcel\FastExcel;
use function App\CPU\translate;
use App\Imports\PublisherImport;
use Excel;
use Image;

class PublisherController extends BaseController
{
    public function index(Request $request)
    {
        
        $search  = $request['search'];

        if($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $publishers = Publisher::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                    $q->orWhere('name_bangla', 'like', "%{$value}%");
                }
            })->paginate(12);
        }else{
            $publishers = Publisher::paginate(12);
        }

        return view('admin-views.publisher.index')
                        ->withPublishers($publishers)
                        ->withSearch($search);
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
        $publisher->name        = ucwords(str_replace('-', ' ', $request->name));
        $publisher->name_bangla = $request->name_bangla;
        $publisher->slug        = Helpers::random_number(5). '-' .Str::slug($request->name);
        if($publisher->slug == '') {
            $publisher->slug = Helpers::random_slug(10);
        }
        // dd($publisher->slug);
        // $publisher->icon = ImageManager::upload('publisher/', 'png', $request->file('image'));
        if($request->hasFile('image')) {
            $image    = $request->file('image');
            $filename = $publisher->slug . '-' . time() .'.' . $image->getClientOriginalExtension();
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
        
    }

    public function update($id, Request $request)
    {
        
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

        unlink(storage_path('app/'.$file));
        return redirect()->route('admin.publisher.index');
    }
}
