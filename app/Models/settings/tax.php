<?php

namespace App\Models\settings;



use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\softDeletes;
class tax extends Model
{
    protected $table="tax";
    protected $connection="mongodb";
}
