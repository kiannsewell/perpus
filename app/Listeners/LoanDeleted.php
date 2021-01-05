<?php

namespace App\Listeners;

use App\Events\LoanDeleted as LoanDeletedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LoanDeleted
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
     * @param  LoanDeleted  $event
     * @return void
     */
    public function handle(LoanDeletedEvent $event)
    {
        $loan = $event->loan;
        $loan->book->status = 0;

        $loan->push();
    }
}
