<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Customer extends Authenticatable
{
    use Notifiable, HasApiTokens;

    public function shippingaddress()
    {
        return $this->hasOne(ShippingAddress::class, 'shipping_addresses');
    }
}
