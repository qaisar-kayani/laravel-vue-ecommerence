<?php

namespace App\Models\catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\softDeletes;
class category extends Model
{
    use HasFactory, softdeletes;

    protected $table="categories";
    protected $connection="mongodb";
    protected $dates=['created_at','updated_at'];
   
    
    public function child()
    {
        return $this->hasMany(category::class,'parent_id');
    }
    public function parent()
    {
       return $this->belongsTo(category::class);
    }
    // category products
    public function product()
    {
     return  $this->hasMany(product::class,'category_id');
    }

    public function child_with_specific()
    {
        return $this->hasMany(category::class,'parent_id')->select(array('id', 'name'));
}



}