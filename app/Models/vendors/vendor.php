<?php

namespace App\Models\vendors;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use App\Models\User;
class vendor extends model
{
    use HybridRelations;
     
    protected $table="vendors";
    protected $primaryKey ="id";

    protected $fillable = [
        'vendor_first_name',
        'vendor_last_name',
        'vendor_email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];


  public function products()
  {
     return $this->hasMany('App\Models\catalog\product','vendor_id');
  }

  public function user()
  {

     return $this->belongsTo(User::class);
  }

  public function cart()
  {
      return $this->belongsToMany(cart::class,'vendorCart');
  }

}
