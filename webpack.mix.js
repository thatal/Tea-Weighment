const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.setResourceRoot(process.env.MIX_RESOURCE_ROOT);
mix.react('resources/js/main.js', 'public/js/app.js')
    .js('resources/js/turbolinks.js', 'public/js/')
   .sass('resources/sass/app.scss', 'public/css');
mix.browserSync(process.env.MIX_APP_URL);
