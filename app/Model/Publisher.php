<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
