let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js');

mix.styles([
    'node_modules/bootstrap-select/dist/css/bootstrap-select.css',
], 'public/plugins/bootstrap-select/css/bootstrap-select.css');

mix.js('node_modules/bootstrap-select/dist/js/bootstrap-select.js','public/plugins/bootstrap-select/js');
mix.js('node_modules/jquery/dist/jquery.js','public/vendor/adminlte/vendor/jquery/dist');
mix.js('node_modules/jquery-slimscroll/jquery.slimscroll.min.js','public/vendor/adminlte/vendor/jquery/dist');
mix.js('node_modules/bootstrap/dist/js/bootstrap.min.js','public/vendor/adminlte/vendor/bootstrap/dist/js');
mix.js('node_modules/jquery-ui/dist/js/bootstrap.min.js','public/vendor/adminlte/vendor/bootstrap/dist/js');

