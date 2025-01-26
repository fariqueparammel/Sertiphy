<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Foundation\Vite;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Vite as FacadesVite;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //renderhook asset registration for global use
        // FilamentAsset::register([
        //     Css::make('custom-sidebar-topbar', __DIR__ . '/../../resources/css/custom-sidebar-topbar.css')->loadedOnRequest(),
        // ]);



        // FilamentView::registerRenderHook(
        //     PanelsRenderHook::HEAD_END,
        //     function () {
        //         if (request()->routeIs('filament.app.pages.certificate-designer')) {
        //             // Combine the <link> and <script> tags into a single string
        //             return Blade::render('
        //                 <link rel="stylesheet" href="' . asset('css/custom-sidebar-topbar.css') . '">
        //                 <script src="' . asset('js/filament/konvaScript.js') . '"></script>
        //             ');
        //         }
        //     }
        // );

        FilamentView::registerRenderHook(
            PanelsRenderHook::HEAD_END,
            function () {
                if (request()->routeIs('filament.app.pages.certificate-designer')) {
                    // Use Vite's helper to generate the asset tags
                    return Blade::render('
                        @vite(["public/css/custom-sidebar-topbar.css", "public/js/filament/konvaScript.js", "public/js/filament/placeDataInCanvas.js"])
                    ');
                }
            }
        );

        // FilamentView::registerRenderHook(

        //     PanelsRenderHook::CONTENT_START,
        //     fn() => '<div class="custom-container">Custom Content Here</div>'
        // );




    }
}
