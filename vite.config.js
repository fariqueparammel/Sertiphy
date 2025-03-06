import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    build: {
        sourcemap: true,
    },
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "public/css/custom-sidebar-topbar.css",
                "public/js/filament/konvaScript.js",
                "public/js/filament/placeDataInCanvas.js",
                "public/js/filament/manualDataEntry.js",
                "public/css/tabulator.css",
            ],
            refresh: true,
        }),
    ],
});
