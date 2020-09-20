<?php

namespace App\Repositories;

use App\Repositories\Concerns\CreateEntities;
use App\Repositories\Concerns\SelectEntities;
use Laravel\Lumen\Application;

class Repository
{
    use CreateEntities;
    use SelectEntities;

    protected $entity;

    protected $model;

    protected $application;

    public function __construct(Application $application)
    {
        $this->application = $application;

        if ($this->entity) {
            $this->resolveEntity();
        }
    }

    public function setEntity($entity): self
    {
        $this->entity = $entity;
        $this->resolveEntity();

        return $this;
    }

    public function setModelMock($model)
    {
        $this->model = $model;
    }

    private function resolveEntity()
    {
        $this->model = $this->application->make($this->entity);
    }
}
