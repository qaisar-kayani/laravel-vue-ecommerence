<?php
namespace App\Models\catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
class attributeValue extends Model
{
    use HasFactory;

    protected $connection = "mongodb";
    protected $table = "attributeValues";

    protected $dates = ['created_at','updated_at','deleted_at'];


    public function attribute()
    {
        return $this->belongsTo(attribute::class);
    }
}
?>