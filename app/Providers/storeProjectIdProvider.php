<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use app\Services\storeProjectIdService;

class storeProjectIdProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(storeProjectIdService::class, function ($app) {
            return new storeProjectIdService();
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
