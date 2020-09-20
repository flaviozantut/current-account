<?php

namespace App\Authorization;

use App\Models\User;

class Client implements Contract
{
    protected $client;

    public function __construct(Contract $client)
    {
        $this->client = $client;
    }

    public function isAuthorized(User $payer, User $payee, float $value): bool
    {
        return $this->client->isAuthorized($payer, $payee, $value);
    }
}
