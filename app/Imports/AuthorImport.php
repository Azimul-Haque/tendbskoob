<?php

namespace App\Imports;

use App\Model\Author;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Support\Str;
use App\CPU\Helpers;

class AuthorImport implements ToModel, WithHeadingRow, SkipsOnError
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $author_slug = Helpers::random_number(5). '-' .Str::slug($row['name']);
        if($author_slug == '') {
            $author_slug = Helpers::random_slug(10);
        }
        // dd($author_slug);
        return new Author([
            'name'            => $row['name'],
            'name_bangla'     => $row['name_bangla'],
            'slug'            => $author_slug,
        ]);
    }

    public function onError(Throwable ) {

    }
}
