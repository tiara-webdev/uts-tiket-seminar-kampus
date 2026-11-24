<?php

namespace App\Modules\Event\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Event\Contracts\EventInfoContract;
use App\Modules\Event\Services\EventInfoService;

class EventServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(EventInfoContract::class, EventInfoService::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
    }
}
