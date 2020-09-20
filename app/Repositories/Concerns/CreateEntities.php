<?php

namespace App\Repositories\Concerns;

use App\Models\Model;
use Illuminate\Support\Arr;

trait CreateEntities
{
    public function create(array $columns): Model
    {
        $filledColumns = Arr::only($columns, $this->model->getFillable());

        return $this->model->create($filledColumns);
    }
}
