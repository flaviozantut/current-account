<?php

namespace App\Listeners;

use App\Events\Transaction as TransactionEvent;
use App\Jobs\Transaction as TransactionJob;
use Illuminate\Support\Facades\Queue;

class Transaction
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(TransactionEvent $event)
    {
        Queue::push(new TransactionJob($event->transaction()));
    }
}
