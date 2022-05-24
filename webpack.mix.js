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

mix.postCss("resources/css/app.css", "public/css", [
  require("tailwindcss"),
])
  .postCss("resources/css/styles.css", "public/css");

mix.postCss("resources/css/filament/custom-theme.css", "public/css/filament.css");
mix.version(['public/js/scripts.js']);
mix.version(['public/js/theme-engine.js']);

mix.js('resources/js/app.js', 'public/js/bundle.js')
  .js('resources/js/turbo.js', 'public/js/turbo.js')
  .sass('resources/css/app.scss', 'public/css/bundle.css', {
    implementation: require('sass'),
    sassOptions: {
      includePaths: ['./node_modules']
    }
  })
  .injectManifest({
    swSrc: './resources/js/sw.js',
    additionalManifestEntries: [
      { url: '/images/plane.svg', revision: 'null' },
      { url: 'site.webmanifest', revision: '100' },

      { url: 'https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js', revision: 'null' },
      { url: 'https://cdn.jsdelivr.net/npm/alpine-turbo-drive-adapter@1.0.x/dist/alpine-turbo-drive-adapter.min.js', revision: 'null' },
      { url: 'https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js', revision: 'null' },
      { url: 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', revision: 'null' },
      { url: 'https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.min.js', revision: 'null' },
      { url: 'https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.js', revision: 'null' },
      { url: 'https://cdn.jsdelivr.net/gh/livewire/vue@v0.3.x/dist/livewire-vue.js', revision: 'null' },
    ],
  });

mix.browserSync({
  proxy: 'localhost',
  snippetOptions: {
    rule: {
      match: /<\/head>/i,
      fn: function (snippet, match) {
        return snippet + match;
      }
    }
  }
});
