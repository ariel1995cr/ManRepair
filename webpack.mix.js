const mix = require("laravel-mix");

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
    .scripts(["resources/js/functions.js"], "public/js/all.js")
    .js("resources/js/app.js", "public/js")
    .sass("resources/css/app.scss", "public/css")
    .css('resources/css/base.css', 'public/css/base/index.css')
    .js("resources/js/base.js", "public/js/base.js")
    .sass("resources/css/tables.scss", "public/css/tablas.css")

