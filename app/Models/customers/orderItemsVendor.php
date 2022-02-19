<?php

namespace App\Models\customers;

use Jenssegers\Mongodb\Eloquent\Model;

class orderItemsVendor extends Model
{

    protected $table = "orderItemsVendor";
    protected $connection = "mongodb";
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
