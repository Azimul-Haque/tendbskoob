<?php

namespace App\Imports;

use App\Model\Author;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

use Illuminate\Support\Str;
use App\CPU\Helpers;

class AuthorImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

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

    public function rules(): array
    {
        return [
            '*.name' => ['required', 'unique:authors,name'],
        ];
    }
}
