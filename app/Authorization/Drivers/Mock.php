<?php

namespace App\Authorization\Drivers;

use App\Authorization\Contract;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class Mock implements Contract
{
    protected $mockUrl = 'https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6';

    const authorized = 'Autorizado';

    public function __construct(string $mockUrl = null)
    {
        if (!is_null($mockUrl)) {
            $this->mockUrl = $mockUrl;
        }
    }

    public function isAuthorized(User $payer, User $payee, float $value): bool
    {
        return Http::get($this->mockUrl)->object()->message === self::authorized;
    }
}
