<?php

namespace App\Models\customers;

use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\catalog\product;
class vendorBidding extends Model
{
    protected $table = "vendorBidding";
    protected $connection = "mongodb";
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];


    public function bidding()
    {
        return $this->belongsTo(bidding::class,'bid_id');
    }

    
    public function product()
    {
        return $this->belongsTo(product::class);
    }
}
