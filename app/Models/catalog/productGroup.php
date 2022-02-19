<?php

namespace App\Models\catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class productGroup extends Model
{
    use HasFactory;
    protected $table = "productGroups";
    protected $connection = "mongodb";
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function product()
    {
        return $this->hasMany(product::class, 'group_id');
    }

    public function vendorGroup()
    {
        return $this->hasMany(vendorGroup::class,'group_id');
    }
}
