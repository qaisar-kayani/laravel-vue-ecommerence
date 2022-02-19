<?php

namespace App\Models\customers;

use Jenssegers\Mongodb\Eloquent\Model;

class customerDefaultAddress extends Model
{

    protected $table = "customerDefaultAddress";
    protected $connection = "mongodb";
    protected $fillable = ['customer_id', 'address_id'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function customerAddress()
    {
        return $this->belongsTo(customerAddress::class);
    }

}
