<?php

namespace App\Models\customers;

use Jenssegers\Mongodb\Eloquent\Model;
use DB;

class customerAddress extends Model
{
   
   protected $table="customerAddress";
   protected $connection="mongodb";
   protected $dates=['created_at','updated_at','deleted_at'];


   public function users()
   {
       return $this->belongsToMany(User::class, 'customerDefaultAddress');
   }

   public function defaultAddress()
   {
       return $this->hasOne(customerDefaultAddress::class,'customer_id');
   }



}