const mix = require('laravel-mix');

const path = require('path');

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

mix
    .setPublicPath('public')
    .js('resources/js/app.js', 'public/js')
    // .js('node_modules/popper.js/dist/popper.js', 'public/js').sourceMaps()
    // .postCss('resources/css/app.css', 'public/css', [
    //     //
    // ])
    .sass('resources/sass/app.scss', 'public/css')
    .version()
    ;