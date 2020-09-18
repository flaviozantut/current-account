<?php

namespace Tests\Integration;

use Tests\TestCase;

class TransactionTest extends TestCase
{
    public function testTransaction(): void
    {
        $data = [
            'value' => 100.00,
            'payer' => 4,
            'payee' => 15,
        ];

        $this->json('POST', 'transaction', $data)
        ->seeJson([
           'created' => true,
        ]);
    }
}
