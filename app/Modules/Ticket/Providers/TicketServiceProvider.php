<?php

namespace App\Modules\Ticket\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Ticket\Contracts\TicketStockContract;
use App\Modules\Ticket\Services\TicketStockService;
use App\Modules\Ticket\Contracts\TicketCatalogContract;
use App\Modules\Ticket\Services\TicketCatalogService;

class TicketServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TicketStockContract::class, TicketStockService::class);
        $this->app->bind(TicketCatalogContract::class, TicketCatalogService::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
    }
}
