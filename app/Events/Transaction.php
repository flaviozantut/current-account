<?php

namespace App\Events;

use App\Models\Transaction as TransactionModel;

class Transaction extends Event
{
    private $transaction;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(TransactionModel $transaction)
    {
        $this->transaction = $transaction;
    }

    public function transaction()
    {
        return $this->transaction;
    }
}
