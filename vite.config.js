import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    server: {
        hmr: false, // Disable Hot Module Replacement
    },
    build: {
        sourcemap: false,
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
    // server: {
    //     port: 5173,
    //     proxy: {
    //         "/api": {
    //             target: "http://127.0.0.1:8000",
    //             changeOrigin: true,
    //             rewrite: (path) => path.replace(/^\/api/, "/api"),
    //         },
    //     },
    // },
});
