<?php

namespace App\Repositories;

use App\Models\Wallet as WalletModel;
use App\Repositories\Concerns\UpdateEntities;

class Wallet extends Repository
{
    use UpdateEntities;

    protected $entity = WalletModel::class;
}
