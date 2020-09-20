<?php

namespace App\Repositories\Concerns;

use Illuminate\Support\Arr;

trait UpdateEntities
{
    public function update(int $modelKey, array $columns)
    {
        $filledColumns = Arr::only($columns, $this->model->getFillable());

        return $this->model
            ->where($this->model->getKeyName(), $modelKey)
            ->update($filledColumns);
    }
}
