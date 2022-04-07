<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $fillable = ['name', 'name_bangla', 'slug'];
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function seller()
    {
        return $this->hasOne('App\Seller');
    }
}
