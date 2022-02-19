<?php

namespace App\Listeners;

use App\Events\VendorBidEvent;
use App\Models\customers\vendorBidding;

class VendorBidEventListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(VendorBidEvent $event)
    {
        //
        $vendorBidding = new vendorBidding;
        $vendorBidding->bidding_id = $event->data['bidding_id'];
        $vendorBidding->bidPrice = $event->data['bidPrice'];
        $vendorBidding->user_id = $event->data['user_id'];
        $vendorBidding->message = $event->data['message'];
        $vendorBidding->product_id = $event->data['product_id'];
        $vendorBidding->vendor_id = $event->data['vendor_id'];
        $vendorBidding->givenPrice=$event->data['givenPrice'];
        $vendorBidding->status = "waiting";
        if ($vendorBidding->save()) {
            return true;
        } else {
            return false;
        }

    }
}
