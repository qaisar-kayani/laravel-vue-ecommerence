<?php

namespace App\Models\settings;


use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\softDeletes;
class productSettings extends Model
{
    protected $table="productSettings";
    protected $connection="mongodb";
}
