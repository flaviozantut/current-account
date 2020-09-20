<?php

namespace App\Services;

use App\Models\User as UserModel;
use App\Repositories\User as UserRepo;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class User extends Service
{
    protected $userRepo;

    protected $wallet;

    public function __construct(UserRepo $userRepo, Wallet $wallet)
    {
        $this->userRepo = $userRepo;
        $this->wallet = $wallet;
    }

    public function find(int $userId)
    {
        return $this->userRepo->find($userId);
    }

    public function findByDocumentId(string $documentId)
    {
        return $this->userRepo->findBy('document_id', $documentId);
    }

    public function create(array $properties): UserModel
    {
        return DB::transaction(function () use ($properties) {
            $user = $this->userRepo->create($properties);

            $user->setRelation('wallet', $this->wallet->create($user));

            return $user;
        });
    }

    public function simplePaginate(int $perPage = 15): Paginator
    {
        return $this->userRepo->simplePaginate($perPage);
    }
}
