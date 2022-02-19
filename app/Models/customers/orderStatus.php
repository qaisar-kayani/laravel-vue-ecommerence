<?php

namespace App\Models\customers;

use Jenssegers\Mongodb\Eloquent\Model;

class orderStatus extends Model
{

    protected $table = "orderStatus";
    protected $connection = "mongodb";
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function order()
    {
        return $this->belongsTo(order::class);
    }

}
