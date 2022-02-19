<?php

namespace App\Models\customers;

use Jenssegers\Mongodb\Eloquent\Model;

class orderVendor extends Model
{

    protected $table = "orderVendor";
    protected $connection = "mongodb";
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function orderItemsVendor()
    {
        return $this->hasMany(orderItemsVendor::class,'vendor_order_id');
    }
    public function orderStatusVendor()
    {
        return $this->hasMany(orderVendor::class,'vendor_order_id');
    }
}
