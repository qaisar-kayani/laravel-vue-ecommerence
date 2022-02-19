<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // Registered::class => [
        //     SendEmailVerificationNotification::class,
        // ],
        \App\Events\NotificationEvent::class => [
            \App\Listeners\NotificationEventListener::class
        ],
        \App\Events\VendorNotificationEvent::class => [
            \App\Listeners\VendorNotificationEventListener::class
        ],
        //  vendor biddig events register

        \App\Events\VendorBidEvent::class => [
            \App\Listeners\VendorBidEventListener::class
        ],

        // order listner
        // \App\Events\createOrderEvent::class => [
        //     \App\Listeners\createOrderEventListener::class
        // ],
        \App\Events\createVendorOrderEvent::class => [
            \App\Listeners\CreateVendorOrderEventListener::class
        ],

        \App\Events\changeBidStatusEvent::class => [
            \App\Listeners\changeBidStatusEventListener::class
        ],



    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
