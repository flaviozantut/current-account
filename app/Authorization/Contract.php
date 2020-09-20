<?php

namespace App\Authorization;

use App\Models\User;

interface Contract
{
    public function isAuthorized(User $payer, User $payee, float $value): bool;
}
