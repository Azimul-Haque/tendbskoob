<?php

namespace App\Imports;

use App\Model\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Illuminate\Support\Str;
use App\CPU\Helpers;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Throwable;

class CategoryImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure, WithBatchInserts, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;

    public function model(array $row)
    {
        $category_slug = Helpers::random_number(5). '-' .Str::slug($row['name']);
        if($category_slug == '') {
            $category_slug = Helpers::random_slug(10);
        }
        // dd($category_slug);
        return new Category([
            'name'        => ucwords(str_replace('-', ' ', $row['name'])),
            'name_bangla' => $row['name_bangla'],
            'slug'        => $category_slug,
        ]);
    }

    public function rules(): array
    {
        return [
            '*.name' => ['required', 'unique:categorys,name'],
        ];
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
