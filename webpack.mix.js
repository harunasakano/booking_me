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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

mix.js('resources/js/navbar.js', 'public/js')

/* SP用のCSS */
mix.sass('resources/sass/SP/header.scss', 'public/css/SP');
mix.sass('resources/sass/SP/top.scss', 'public/css/SP');

/* PC用のCSS */
mix.sass('resources/sass/PC/header.scss', 'public/css/PC');
mix.sass('resources/sass/PC/top.scss', 'public/css/PC');
