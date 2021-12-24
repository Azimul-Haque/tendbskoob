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
use App\Model\Review;
use App\Model\Translation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Rap2hpoutre\FastExcel\FastExcel;
use function App\CPU\translate;
use Illuminate\Filesystem\Filesystem;
use App\Imports\AuthorImport;
use Excel;
use Image;

class AuthorController extends BaseController
{
    public function index(Request $request)
    {
        
        $search  = $request['search'];

        if($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $authors = Author::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                    $q->orWhere('name_bangla', 'like', "%{$value}%");
                }
            })->paginate(12);
        }else{
            $authors = Author::paginate(12);
        }

        $totalauthors = Author::get()->count();
        // dd($totalauthors);

        return view('admin-views.author.index')
                        ->withAuthors($authors)
                        ->withTotalauthors($totalauthors)
                        ->withSearch($search);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required | unique:authors,name',
            'name_bangla' => 'required',
            'image'       => 'sometimes',
            'description' => 'sometimes'
        ], [
            'name.required' => 'Author name is required!',
        ]);

        $author              = new Author;
        $author->name        = Str::slug($request->name) == '' ? $request->name : ucwords(str_replace('-', ' ', $request->name));
        $author->name_bangla = $request->name_bangla;
        $author->slug        = Helpers::random_number(10). '-' . Str::slug($request->name);
        if(Str::slug($request->name) == '') {
            $author->slug = Helpers::random_slug(15) . '-' . Helpers::random_number(5);
        }
        // dd($author->slug);
        // $author->icon = ImageManager::upload('author/', 'png', $request->file('image'));
        if($request->hasFile('image')) {
            $image    = $request->file('image');
            $filename = $author->slug . '-' . time() .'.' . $image->getClientOriginalExtension();
            $location = public_path('/public/images/author/'. $filename);
            Image::make($image)->resize(200, 200)->save($location);
            $author->image = $filename;
            // $author->image = ImageManager::upload('author/', 'png', $request->file('image'));
        }
        $author->description = $request->description;
        $author->save();

        Toastr::success('Author added successfully!');
        return redirect()->route('admin.author.index');
    }

    public function edit($id)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'name_bangla' => 'required',
        //     'image' => 'sometimes',
        //     'description' => 'sometimes'
        // ], [
        //     'name.required' => 'Author name is required!',
        // ]);

        // $author = new Author;
        // $author->name = $request->name;
        // $author->name_bangla = $request->name_bangla;
        // $author->slug = Helpers::random_number(5). '-' .Str::slug($request->name);
        // if($author->slug == '') {
        //     $author->slug = Helpers::random_slug(10);
        // }
        // // dd($author->slug);
        // // $author->icon = ImageManager::upload('author/', 'png', $request->file('image'));
        // if($request->hasFile('image')) {
        //     $image      = $request->file('image');
        //     $filename   = $author->slug . time() .'.' . $image->getClientOriginalExtension();
        //     $location   = public_path('/images/author/'. $filename);
        //     Image::make($image)->resize(200, 200)->save($location);
        //     $author->image = $filename;
        // }
        // $author->description = $request->description;
        // $author->save();

        // Toastr::success('Author added successfully!');
        // return redirect()->route('admin.author.index');
    }

    public function update($id, Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'name_bangla' => 'required',
        //     'image' => 'sometimes',
        //     'description' => 'sometimes'
        // ], [
        //     'name.required' => 'Author name is required!',
        // ]);

        // $author = new Author;
        // $author->name = $request->name;
        // $author->name_bangla = $request->name_bangla;
        // $author->slug = Helpers::random_number(5). '-' .Str::slug($request->name);
        // if($author->slug == '') {
        //     $author->slug = Helpers::random_slug(10);
        // }
        // // dd($author->slug);
        // // $author->icon = ImageManager::upload('author/', 'png', $request->file('image'));
        // if($request->hasFile('image')) {
        //     $image      = $request->file('image');
        //     $filename   = $author->slug . time() .'.' . $image->getClientOriginalExtension();
        //     $location   = public_path('/images/author/'. $filename);
        //     Image::make($image)->resize(200, 200)->save($location);
        //     $author->image = $filename;
        // }
        // $author->description = $request->description;
        // $author->save();

        // Toastr::success('Author added successfully!');
        // return redirect()->route('admin.author.index');
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
          $import = new AuthorImport;
          $import->import($file);
          if($import->failures()->count() > 0) {
              Toastr::info('Authors from Excel File added successfully!<br>' . $import->failures()->count() . ' duplicate entries skipped.');
          } else {
            Toastr::success('Authors from Excel File added successfully!');
          }
        } catch (\Exception $e) {
            // return $e->getMessage();
            Toastr::warning('Error! Try with correct format.<br><small>' .$e->getMessage() . '</small>');
        }

        // unlink(storage_path('app/'.$file));
        $deletefile = new Filesystem;
        $deletefile->cleanDirectory(storage_path('app/import'));
        $deletefile->cleanDirectory(storage_path('debugbar'));
        return redirect()->route('admin.author.index');
    }
}
