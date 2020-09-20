<?php

namespace App\Listeners;

use App\Events\Transaction as TransactionEvent;
use App\Notification\Notifier;

class Transaction
{
    private $notifier;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Notifier $notifier)
    {
        $this->notifier = $notifier;
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(TransactionEvent $event)
    {
        $this->notifier->notify($event->transaction());
    }
}
