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
use App\CPU\ImageManager;
use App\CPU\BackEndHelper;
use App\Model\Translation;
use App\Model\DealOfTheDay;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Imports\AuthorImport;
use App\Model\FlashDealProduct;
use function App\CPU\translate;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Filesystem\Filesystem;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Helper\Helper;

class AuthorController extends BaseController
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
            $authors = Author::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                    $q->orWhere('name_bangla', 'like', "%{$value}%");
                }
            })->orderBy('name_bangla', $orderby)
              ->paginate(12);
            $query_param = ['search' => $request['search']];
        }else{
            $authors = Author::orderBy('name_bangla', $orderby)->paginate(12);
        }
        $authors->appends($query_param);
        $totalauthors = Author::get()->count();
        // dd($totalauthors);

        return view('admin-views.author.index')
                        ->withAuthors($authors)
                        ->withTotalauthors($totalauthors)
                        ->withSearch($search)
                        ->withOrderby($orderby);
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
            // $filename = Helpers::random_slug(10) . '.' . $image->getClientOriginalExtension();
            $filename = Helpers::random_slug(10) . '.jpg';
            $location = public_path('/public/images/author/'. $filename);
            Image::make($image)->fit(200, 200)->save($location);
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
        $author = Author::withoutGlobalScopes()->find($id);
        // dd($author);
        return view('admin-views.author.edit', compact('author'));
    }

    public function update($id, Request $request)
    {
        $author = Author::find($request->id);
        $oldname = $author->name;
        $author->name        = Str::slug($request->name) == '' ? $request->name : ucwords(str_replace('-', ' ', $request->name));
        $author->name_bangla = $request->name_bangla;
        if($oldname != ucwords(str_replace('-', ' ', $request->name))) {
            $author->slug        = Helpers::random_number(10). '-' . Str::slug($request->name);
            if(Str::slug($request->name) == '') {
                $author->slug = Helpers::random_slug(15) . '-' . Helpers::random_number(5);
            }
        }
        if($request->hasFile('image')) {
            $image_path = public_path('/public/images/author/'. $author->image);
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $image    = $request->file('image');
            // $filename = Helpers::random_slug(10) . '.' . $image->getClientOriginalExtension();
            $filename = Helpers::random_slug(10) . '.jpg';
            $location = public_path('/public/images/author/'. $filename);
            Image::make($image)->fit(200, 200)->save($location);
            $author->image = $filename;
            // $author->image = ImageManager::upload('author/', 'png', $request->file('image'));
        }
        $author->description = $request->description;
        $author->save();

        Toastr::success('Author updated successfully!');
        return redirect()->route('admin.author.index');
    }

    public function delete(Request $request)
    {
        $author = Author::find($request->id);
        $image_path = public_path('/public/images/author/'. $author->image);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        // dd($image_path);
        $author->delete();
        Toastr::success('Author removed successfully!');
        return redirect()->route('admin.author.index');
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
