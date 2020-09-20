<?php

namespace Tests\Integration;

use Tests\TestCase;

class CreateUserWithCreditTest extends TestCase
{
    public function testCreateUserOne(): void
    {
        $data = [
            'full_name' => 'user name1',
            'email' => 'user1@email.com',
            'document_id' => '58739229009',
            'type' => 'commom',
        ];

        $this
            ->json('POST', 'user', $data)
            ->seeStatusCode(204);
    }

    public function testAddUserOneCredit(): void
    {
        $data = [
            'value' => 10,
        ];

        $this
            ->json('POST', 'user/document_id/58739229009/credit', $data)
            ->seeStatusCode(204);
    }

    public function testUserOneGet(): void
    {
        $this
            ->json('GET', 'user/document_id/58739229009')
            ->seeJson(['wallet' => [
                'amount' => 10,
            ]]);
    }

    public function testCreateUserTwo(): void
    {
        $data = [
            'full_name' => 'user name2',
            'email' => 'user2@email.com',
            'document_id' => '75689765058',
            'type' => 'commom',
        ];

        $this
            ->json('POST', 'user', $data)
            ->seeStatusCode(204);
    }

    public function testAddUserTwoCredit(): void
    {
        $data = [
            'value' => 5,
        ];

        $this
            ->json('POST', 'user/document_id/75689765058/credit', $data)
            ->seeStatusCode(204);
    }

    public function testUserTwoGet(): void
    {
        $this
            ->json('GET', 'user/document_id/75689765058')
            ->seeJson(['wallet' => [
                'amount' => 5,
            ]]);
    }

    public function testCreateUserThree(): void
    {
        $data = [
            'full_name' => 'user name3',
            'email' => 'user3@email.com',
            'document_id' => '40848325000143',
            'type' => 'shopkeeper',
        ];

        $this
            ->json('POST', 'user', $data)
            ->seeStatusCode(204);
    }

    public function testAddUserThreeCredit(): void
    {
        $data = [
            'value' => 32.50,
        ];

        $this
            ->json('POST', 'user/document_id/40848325000143/credit', $data)
            ->seeStatusCode(204);
    }

    public function testUserThreeGet(): void
    {
        $this
            ->json('GET', 'user/document_id/40848325000143')
            ->seeJson(['wallet' => [
                'amount' => 32.50,
            ]]);
    }
}
