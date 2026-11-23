<?php

namespace App\Modules\Ticket\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Ticket\Contracts\TicketStockContract;
use App\Modules\Ticket\Services\TicketStockService;

class TicketServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TicketStockContract::class, TicketStockService::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
    }
}
