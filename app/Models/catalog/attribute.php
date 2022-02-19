<?php

namespace App\Models\catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\softDeletes;
class attribute extends Model
{
    use HasFactory,softDeletes;

    protected $connection = "mongodb";
    protected $table = "attributes";

    protected $dates = ['created_at','updated_at','deleted_at'];
    //mutator
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }
    
    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtolower($value);
    }


    public function attributeValues()
    {
        return $this->hasMany(attributeValue::class,'attribute_id');
    }

}
