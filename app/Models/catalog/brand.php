<?php

namespace App\Models\catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    use HasFactory;

        
    protected $table="brands";
    protected $connection="mongodb";

    public function product()
    {

        $this->hasMany(product::class,'brand_id');
    }
}
