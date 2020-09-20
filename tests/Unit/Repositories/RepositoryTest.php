<?php

namespace Tests\Unit\Repositories;

use App\Models\Model;
use App\Repositories\Repository;
use Mockery;
use Tests\TestCase;

class RepositoryTest extends TestCase
{
    protected $modelMock;

    protected $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->modelMock = Mockery::mock(Model::class);

        $this->repository = $this->app->make(Repository::class);
        $this->repository->setModelMock($this->modelMock);
    }

    public function testCreate()
    {
        $this->modelMock
            ->shouldReceive('create')
            ->once()
            ->with(['foo' => 'bar'])
            ->andReturn(new Model());

        $this->modelMock
            ->shouldReceive('getFillable')
            ->once()
            ->andReturn(['foo']);

        $this->repository->create(['foo' => 'bar']);
    }
}
