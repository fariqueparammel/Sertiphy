<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Foundation\Vite;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Vite as FacadesVite;


class luckysheetServiceprovider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        FilamentView::registerRenderHook(
            PanelsRenderHook::HEAD_END,
            function () {
                if (request()->routeIs('filament.app.resources.projects.data-entry')) {
                    // Use Vite's helper to generate the asset tags


                    return Blade::render('

<link href="https://unpkg.com/tabulator-tables/dist/css/tabulator.min.css" rel="stylesheet">

                    @vite(["public/js/filament/manualDataEntry.js","public/css/tabulator.css"])
                ');



                    // return Blade::render('
                    //     @vite(["D:\College Project\testapp\public\js\filament\manualDataEntry.js"])
                    // ');
                }
            }
        );
    }
}
