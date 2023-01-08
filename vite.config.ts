import crypto from 'crypto';
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { VitePWA } from 'vite-plugin-pwa';

let routesHash: string | undefined;
const getOrBuildHash = () => {
    if (!routesHash) {
        const useRandom = `${Math.random()}-${new Date().toISOString()}`;
        const cHash = crypto.createHash('MD5');
        cHash.update(useRandom, 'utf-8');
        routesHash = cHash.digest('hex');
    }
    return routesHash;
};

const cachePages = ['dashboard', 'agenda', 'assignments'];
const additionalManifestEntries: any[] = [];

cachePages.forEach((path: string) => {
    additionalManifestEntries.push({
        url: path.startsWith('/') ? path.substring(1) : path,
        revision: `${getOrBuildHash()}`,
    });
});

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js', 'resources/css/app.scss'],
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
                /*icons: [
                    {
                        src: 'images/logo/android-chrome-192x192.png',
                        type: 'image/png',
                        sizes: '192x192',
                        purpose: 'any',
                    },
                    {
                        src: 'images/logo/maskable_icon.png',
                        sizes: '196x196',
                        type: 'image/png',
                        purpose: 'maskable',
                    },
                    {
                        src: 'images/logo/android-chrome-512x512.png',
                        type: 'image/png',
                        sizes: '512x512',
                    },
                ],*/
                orientation: 'portrait-primary',
            },
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources/js',
        },
    },
});
