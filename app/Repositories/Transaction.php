<?php

namespace App\Repositories;

use App\Models\Transaction as TransactionModel;

class Transaction extends Repository
{
    protected $entity = TransactionModel::class;
}
