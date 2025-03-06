<?php

namespace App\Providers;

use app\Services\getJsonDataService;
use Illuminate\Support\ServiceProvider;

class certificateDesignerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(getJsonDataService::class, function ($app) {
            return new getJsonDataService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
