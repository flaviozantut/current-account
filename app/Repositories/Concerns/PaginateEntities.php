<?php

namespace App\Repositories\Concerns;

trait PaginateEntities
{
    public function simplePaginate(int $perPage)
    {
        return $this->model->simplePaginate($perPage);
    }
}
