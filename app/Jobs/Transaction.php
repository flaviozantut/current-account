<?php

namespace App\Jobs;

use App\Models\Transaction as TransactionModel;
use App\Notification\Notifier;

class Transaction extends Job
{
    private $transaction;

    public function __construct(TransactionModel $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Notifier $notifier)
    {
        $notifier->notify($this->transaction);
    }
}
