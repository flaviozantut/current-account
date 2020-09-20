<?php

namespace App\Providers;

use App\Authorization\Contract as AuthorizationContract;
use App\Authorization\Drivers\Mock as AuthorizationMock;
use App\Notification\Contract as NotificationContract;
use App\Notification\Drivers\Mock as NotificationMock;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthorizationContract::class, AuthorizationMock::class);
        $this->app->bind(NotificationContract::class, NotificationMock::class);
    }
}
