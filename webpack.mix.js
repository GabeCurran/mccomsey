const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);

mix.scripts([
    'node_modules/ckeditor5-build-laravel-image/build/ckeditor.js',
  ], 'public/js/vendors.js');

  mix.scripts([
    'node_modules/ckeditor5-build-laravel-image/build/ckeditor.js.map',
  ], 'public/js/ckeditor.js.map');