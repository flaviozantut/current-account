<?php

namespace App\Repositories;

use App\Models\User as UserModel;
use App\Repositories\Concerns\PaginateEntities;

class User extends Repository
{
    use PaginateEntities;

    protected $entity = UserModel::class;
}
