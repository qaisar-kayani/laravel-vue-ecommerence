<?php

namespace App\Models\customers;

use Jenssegers\Mongodb\Eloquent\Model;
class cartItems extends Model
{
   

   protected $table="cartItems";
   protected $connection="mongodb";
   protected $dates=['created_at','updated_at','deleted_at'];

   public function cart()
   {
       return $this->belongsTo(cart::class);
   }

}