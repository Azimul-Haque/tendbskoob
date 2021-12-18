<?php

namespace App\Imports;

use App\Model\Publisher;
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

class PublisherImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure, WithBatchInserts, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;

    public function model(array $row)
    {
        $publisher_slug = Helpers::random_number(5). '-' .Str::slug($row['name']);
        if($publisher_slug == '') {
            $publisher_slug = Helpers::random_slug(10);
        }
        // dd($publisher_slug);
        return new Publisher([
            'name'        => ucwords(str_replace('-', ' ', $row['name'])),
            'name_bangla' => $row['name_bangla'],
            'slug'        => $publisher_slug,
        ]);
    }

    public function rules(): array
    {
        return [
            '*.name' => ['required', 'unique:publishers,name'],
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
