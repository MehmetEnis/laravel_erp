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

mix.js([
        'resources/js/app.js',
        'node_modules/datatables.net-select-dt/js/select.dataTables.min.js',
        'node_modules/select2/dist/js/select2.min.js',
        'resources/js/adminLTE.js',
    ], 'public/js')
    .styles([
        'node_modules/datatables.net-select-dt/css/select.dataTables.css',
        'node_modules/select2/dist/css/select2.min.css',
        'node_modules/datatables.net-dt/css/jquery.dataTables.min.css'
    ],'public/css/selectDatatables.css')
    .sass('resources/sass/app.scss', 'public/css')
    .less('node_modules/admin-lte/build/less/AdminLTE.less', 'public/css')
    .less('node_modules/admin-lte/build/less/skins/skin-red.less', 'public/css')
    .less('node_modules/bootstrap/less/bootstrap.less', 'public/css')
    .combine('public/css/*', 'public/css/all.css');