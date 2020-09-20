<?php

namespace Tests\Integration;

use Tests\TestCase;

class TransactionTest extends TestCase
{
    public function testTransactionUserOneToTwo()
    {
        $this
            ->json('GET', '/user/id/1')
            ->seeJson(['wallet' => [
                'amount' => 10,
            ]]);

        $this
            ->json('GET', '/user/id/2')
            ->seeJson(['wallet' => [
                'amount' => 5,
            ]]);

        $this->json('POST', 'transaction', [
            'value' => 10,
            'payer' => 1,
            'payee' => 2,
        ])
        ->seeStatusCode(204);

        $this
            ->json('GET', '/user/id/1')
            ->seeJson(['wallet' => [
                'amount' => 0,
            ]]);

        $this
            ->json('GET', '/user/id/2')
            ->seeJson(['wallet' => [
                'amount' => 15,
            ]]);
    }

    public function testTransactionUserTwoToOne()
    {
        $this
            ->json('GET', '/user/id/1')
            ->seeJson(['wallet' => [
                'amount' => 0,
            ]]);

        $this
            ->json('GET', '/user/id/2')
            ->seeJson(['wallet' => [
                'amount' => 15,
            ]]);

        $this->json('POST', 'transaction', [
            'value' => 10,
            'payer' => 2,
            'payee' => 1,
        ])
        ->seeStatusCode(204);

        $this
            ->json('GET', '/user/id/1')
            ->seeJson(['wallet' => [
                'amount' => 10,
            ]]);

        $this
            ->json('GET', '/user/id/2')
            ->seeJson(['wallet' => [
                'amount' => 5,
            ]]);
    }

    public function testTransactionUserOneToThree()
    {
        $this
            ->json('GET', '/user/id/1')
            ->seeJson(['wallet' => [
                'amount' => 10,
            ]]);

        $this
            ->json('GET', '/user/id/3')
            ->seeJson(['wallet' => [
                'amount' => 32.5,
            ]]);

        $this->json('POST', 'transaction', [
                'value' => 2.5,
                'payer' => 1,
                'payee' => 3,
            ])
            ->seeStatusCode(204);

        $this
            ->json('GET', '/user/id/1')
            ->seeJson(['wallet' => [
                'amount' => 7.5,
            ]]);

        $this
            ->json('GET', '/user/id/3')
            ->seeJson(['wallet' => [
                'amount' => 35,
            ]]);
    }
}
