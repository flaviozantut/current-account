<?php

namespace App\Notification\Drivers;

use App\Models\Transaction;
use App\Notification\Contract;
use App\Notification\Exception;
use Illuminate\Support\Facades\Http;

class Mock implements Contract
{
    protected $mockUrl = 'https://run.mocky.io/v3/b19f7b9f-9cbf-4fc6-ad22-dc30601aec04';

    const sent = 'Enviado';

    public function __construct(string $mockUrl = null)
    {
        if (!is_null($mockUrl)) {
            $this->mockUrl = $mockUrl;
        }
    }

    public function notify(Transaction $transaction): void
    {
        try {
            throw_if(Http::get($this->mockUrl)->object()->message !== self::sent, new Exception(''));
        } catch (\Throwable $th) {
            throw new Exception('Message not sent.');
        }
    }
}
