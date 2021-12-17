<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function products() {
      return $this->belongsToMany(Product::class)->withPivot('author_type');
    }
}
