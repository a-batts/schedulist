import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/app.scss',
                'resources/css/filament/custom-theme.css',
                'resources/js/app.js',
                'resources/js/turbo.js',
            ],
            refresh: true,
        }),
    ],
});
