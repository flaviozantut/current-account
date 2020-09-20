<?php

namespace App\Repositories\Concerns;

use App\Models\Model;

trait SelectEntities
{
    public function find(int $modelId): Model
    {
        return $this->model->findOrFail($modelId);
    }

    public function findBy(string $attribute, $key): Model
    {
        return $this->model->where($attribute, '=', $key)->firstOrFail();
    }
}
