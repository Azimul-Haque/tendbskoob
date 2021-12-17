<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function writers() {
      return $this->hasMany(Product::class, 'writer_id', 'id');
    }

    public function translators() {
      return $this->hasMany(Product::class, 'translator_id', 'id');
    }

    public function editors() {
      return $this->hasMany(Product::class, 'editor_id', 'id');
    }
}
