<?php



namespace App\Models\settings;

use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\vendors\vendor;
class vendorNotification extends Model
{

    use HybridRelations;
    protected $table = "vendorNotification";
    protected $connection = "mongodb";
    protected $dates = ['created_at','seen_at', 'updated_at', 'deleted_at'];

    

    

}
