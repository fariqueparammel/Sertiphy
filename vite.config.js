import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    build:

    {
         sourcemap: true,

    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js','resource/css/custom-sidebar-topbar.css'],
            refresh: true,
        }),
    ],
});
