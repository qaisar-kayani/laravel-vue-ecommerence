<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class country extends Model
{
    protected $table="countries";
    protected $connection="mongodb";
}
