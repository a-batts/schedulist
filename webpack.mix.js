let mix = require('laravel-mix');

require('laravel-mix-workbox');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.postCss('resources/css/app.css', 'public/css', [
    require('tailwindcss'),
]).postCss(
    'resources/css/filament/custom-theme.css',
    'public/css/filament.css'
);
mix.version(['public/js/scripts.js']).version(['public/js/theme-engine.js']);

mix.js('resources/js/app.js', 'public/js/bundle.js')
    .js('resources/js/turbo.js', 'public/js/turbo.js')
    .sass('resources/css/app.scss', 'public/css/bundle.css', {
        implementation: require('sass'),
        sassOptions: {
            includePaths: ['./node_modules'],
        },
    })
    .injectManifest({
        swSrc: './resources/js/sw.js',
        additionalManifestEntries: [
            { url: 'site.webmanifest', revision: '100' },

            {
                url: 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js',
                revision: 'null',
            },
        ],
    });

mix.browserSync({
    proxy: 'localhost',
    snippetOptions: {
        rule: {
            match: /<\/head>/i,
            fn: function (snippet, match) {
                return snippet + match;
            },
        },
    },
});
