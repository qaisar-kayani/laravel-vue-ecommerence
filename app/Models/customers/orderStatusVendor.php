<?php


namespace App\Models\customers;

use Jenssegers\Mongodb\Eloquent\Model;

class orderStatusVendor extends Model
{

    protected $table = "orderStatusVendor";
    protected $connection = "mongodb";
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function orderVendor()
    {
        return $this->belongsTo(orderVendor::class,'vendor_order_id');
    }

}
