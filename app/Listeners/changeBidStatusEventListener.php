<?php

namespace App\Listeners;

use App\Events\changeBidStatusEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\customers\bidding;
use App\Models\customers\vendorBidding;
use App\Helpers\Helpers;
class changeBidStatusEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\changeBidStatusEvent  $event
     * @return void
     */
    public function handle(changeBidStatusEvent $event)
    {
        //
        $vendorBidding=vendorBidding::find($event->bid['vendorBidId']);
        $vendorBidding->status="accepted";
        $vendorBidding->updated_at=Helpers::get_mongo_date(date('Y-m-d H:i:s'));
        $vendorBidding->save();
        if($event->bid['status']==="accepted")
        {
        $bidding=bidding::find($vendorBidding->bidding_id);
        $bidding->status="accepted";
        $bidding->save();
        }
        
    }
}
