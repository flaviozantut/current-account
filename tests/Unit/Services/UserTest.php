<?php

namespace Tests\Unit\Services;

use App\Models\User as UserModel;
use App\Models\Wallet as WalletModel;
use App\Repositories\User as UserRepo;
use App\Services\User;
use App\Services\Wallet as WalletService;
use Mockery;
use Tests\TestCase;

class UserTest extends TestCase
{
    protected $user;

    protected $repository;

    protected $userRepoMock;

    protected $walletServiceMock;

    public function setUp(): void
    {
        parent::setUp();

        $this->userRepoMock = Mockery::mock(UserRepo::class);
        $this->app->instance(UserRepo::class, $this->userRepoMock);

        $this->walletServiceMock = Mockery::mock(WalletService::class);
        $this->app->instance(WalletService::class, $this->walletServiceMock);

        $this->user = $this->app->make(User::class);
    }

    public function testCreate()
    {
        $userAttributes = [
            'type' => UserModel::commomType,
            'full_name' => 'Full Name',
            'email' => 'user@email.com',
            'document_id' => '99999999999',
        ];

        $user = new UserModel($userAttributes);

        $this->userRepoMock
            ->shouldReceive('create')
            ->once()
           ->with($userAttributes)
            ->andReturn($user);

        $this->walletServiceMock
            ->shouldReceive('create')
            ->once()
             ->with($user)
            ->andReturn(new WalletModel());

        $this->assertEquals(
            $user,
            $this->user->create($userAttributes)
        );
    }
}
