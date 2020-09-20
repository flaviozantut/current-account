<?php

namespace App\Notification;

use App\Models\Transaction;
use Illuminate\Support\Facades\Log;

class Notifier implements Contract
{
    protected $notifier;

    public function __construct(Contract $notifier)
    {
        $this->notifier = $notifier;
    }

    public function notify(Transaction $transaction): void
    {
        $this->notifier->notify($transaction);

        Log::info('NOTIFIED_TRANSACTION', [$transaction->toArray()]);
    }
}
