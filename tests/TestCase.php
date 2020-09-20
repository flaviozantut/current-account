<?php

namespace Tests;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;
use Mockery;

abstract class TestCase extends BaseTestCase
{
    protected static $migrationsRun = false;

    protected $knownDate;

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    protected function setUp(): void
    {
        parent::setUp();
        if (!static::$migrationsRun) {
            Artisan::call('migrate:fresh');
            static::$migrationsRun = true;
        }
    }

    protected function tearDown(): void
    {
        $this->beforeApplicationDestroyed(fn () => DB::disconnect());
        parent::tearDown();

        Mockery::close();
    }
}
