<?php

namespace App\Models\customers;

use Jenssegers\Mongodb\Eloquent\Model;
use DB;
class orderItems extends Model
{
   
   protected $table="orderItems";
   protected $connection="mongodb";
   protected $dates=['created_at','updated_at','deleted_at'];
   
   public function order()
   {
       return $this->belongsTo(order::class);
   }


}