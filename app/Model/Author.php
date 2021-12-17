<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
  protected $fillable = ['name', 'name_bangla', 'slug'];
  
  public function products() {
    return $this->belongsToMany(Product::class)->withPivot('author_type');
  }
}
