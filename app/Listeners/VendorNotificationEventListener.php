<?php

namespace App\Listeners;

use App\Events\VendorNotificationEvent;
use App\Models\settings\vendorNotification;
use Auth;
use Carbon\Carbon;
use Log;

class VendorNotificationEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //Log::info('event fired');
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(VendorNotificationEvent $event)
    {
        //
        if (isset($event->notification['id']) && $event->notification['id'] != '') {
            $notification = vendorNotification::find($event->notification['id']);
            $notification->updated_at = Carbon::now();
            if (Auth::user()) {
                $notification->seen_at = Carbon::now();
                $notification->seen_by=Auth::user()->id;
            }

        } else {
            $notification = new vendorNotification;
        }

        $notification->type = $event->notification['type'];
        $notification->vendor_id = $event->notification['vendor_id'];
        $notification->message = $event->notification['message'];
        $notification->status = $event->notification['status'];
        $notification->seen_at=null;
        $notification->seen_by=null;
        $notification->created_at = Carbon::now();
        $notification->save();

    }
}
