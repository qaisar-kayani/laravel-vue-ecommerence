<?php

namespace App\Models\catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class vendorGroup extends Model
{
    use HasFactory;
    protected $table = "vendorGroups";
    protected $connection = "mongodb";
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];


}
