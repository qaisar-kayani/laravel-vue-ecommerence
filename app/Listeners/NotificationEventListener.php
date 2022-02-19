<?php

namespace App\Listeners;

use App\Events\NotificationEvent;
use App\Models\settings\notification;
use Auth;
use Carbon\Carbon;
use Log;

class NotificationEventListener
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

   
    public function handle(NotificationEvent $event)
    {
        //
        if (isset($event->notification['id']) && $event->notification['id'] != '') {
            $notification = notification::find($event->notification['id']);
            $notification->updated_at = Carbon::now();
            if (Auth::user()) {
                $notification->seen_at = Carbon::now();
                $notification->seen_by=Auth::user()->id;
            }

        } else {
            $notification = new notification;
        }

        $notification->type = $event->notification['type'];
        $notification->message = $event->notification['message'];
        $notification->status = $event->notification['status'];
        $notification->seen_at=null;
        $notification->seen_by=null;
        $notification->created_at = Carbon::now();
        $notification->save();

    }
}
