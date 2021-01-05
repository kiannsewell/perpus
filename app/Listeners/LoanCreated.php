<?php

namespace App\Listeners;

use App\Events\LoanCreated as LoanCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LoanCreated
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
     * @param  LoanCreated  $event
     * @return void
     */
    public function handle(LoanCreatedEvent $event)
    {
        $loan = $event->loan;
        $loan->book->status = 1;

        $loan->push();
    }
}
