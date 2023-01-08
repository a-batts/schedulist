import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { VitePWA } from 'vite-plugin-pwa';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/js/vendor.js',
                'resources/css/app.scss',
            ],
            refresh: true,
        }),
        VitePWA({
            injectRegister: 'script',
            strategies: 'injectManifest',
            srcDir: 'resources/js',
            outDir: 'public',
            filename: 'sw.js',
            scope: '/',
            base: '',
            manifest: {
                name: 'Schedulist',
                short_name: 'Schedulist',
                start_url: '/app',
                display: 'standalone',
                theme_color: '#3367D6',
                background_color: '#121212',
                scope: '/',
                icons: [
                    {
                        src: '../images/logo/android-chrome-192x192.png',
                        type: 'image/png',
                        sizes: '192x192',
                        purpose: 'any',
                    },
                    {
                        src: '../images/logo/maskable_icon.png',
                        sizes: '196x196',
                        type: 'image/png',
                        purpose: 'maskable',
                    },
                    {
                        src: '../images/logo/android-chrome-512x512.png',
                        type: 'image/png',
                        sizes: '512x512',
                    },
                ],
                orientation: 'portrait-primary',
            },
        }),
        viteStaticCopy({
            targets: [
                {
                    src: 'public/build/manifest.webmanifest',
                    dest: '../',
                },
            ],
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources/js',
        },
    },
});
