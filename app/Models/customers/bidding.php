<?php

namespace App\Models\customers;


use Jenssegers\Mongodb\Eloquent\Model;


class bidding extends Model
{
    protected $table = "biddings";
    protected $connection = "mongodb";
    protected $dates = ['created_at', 'updated_at', 'deleted_at','start_time','end_time'];

    public function vendorBidding()
    {
        return $this->hasMany(vendorBidding::class, 'bidding_id');
    }
    
    public function biddingMinPrice()
    {
        return $this->hasMany(vendorBidding::class, 'bidding_id')->min('givenPrice');
    }

}



