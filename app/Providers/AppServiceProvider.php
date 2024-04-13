<?php

namespace App\Providers;

use App\Interfaces\HomeInterface;
use App\Interfaces\PropertyInterface;
use App\Services\HomeService;
use App\Services\PropertyService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(HomeInterface::class, HomeService::class);
        $this->app->bind(PropertyInterface::class, PropertyService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrapFive();
    }
}
