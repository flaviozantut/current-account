<?php

namespace App\Notification;

use App\Models\Transaction;

interface Contract
{
    public function notify(Transaction $transaction): void;
}
