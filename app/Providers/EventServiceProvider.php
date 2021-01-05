<?php

namespace App\Providers;

use App\Events\LoanCreated as LoanCreatedEvent;
use App\Listeners\LoanCreated as LoanCreatedListener;
use App\Events\LoanDeleted as LoanDeletedEvent;
use App\Listeners\LoanDeleted as LoanDeletedListener;

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
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        LoanCreatedEvent::class => [
            LoanCreatedListener::class,
        ],
        LoanDeletedEvent::class => [
            LoanDeletedListener::class,
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
