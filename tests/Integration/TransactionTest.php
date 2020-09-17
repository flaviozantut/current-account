<?php
namespace Tests\Integration;

use Tests\TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class TransactionTest extends TestCase
{
    public function testTransaction()
    {

        $data = [
            'value' => 100.00,
            'payer' => 4,
            'payee' => 15
        ];
        
        $this->json('POST', 'transaction', $data)
        ->seeJson([
           'created' => true,
        ]);
    }
}
