<?php

namespace App\Models\customers;

use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\vendors\vendor;
class cart extends Model
{

    use HybridRelations;
    protected $table = "carts";
    protected $connection = "mongodb";
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function cartItems()
    {
        return $this->hasMany(cartItems::class, 'cart_id');
    }

    public function vendor()
    {
        return $this->hasOne(cartVendors::class);
    }

}
