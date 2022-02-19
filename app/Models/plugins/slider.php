<?php

namespace App\Models\plugins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class slider extends Model
{
    use HasFactory;
        
    protected $table="sliders";
    protected $connection="mongodb";
}
