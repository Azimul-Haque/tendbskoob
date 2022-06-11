<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $casts = [
        'customer_id' => 'integer',
    ];

    public function shippingaddresses()
    {
        return $this->hasMany(ShippingAddress::class, 'shipping_address');
    }
}
