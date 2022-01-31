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

mix .js('resources/js/app.js', 'public/js')
    .js('resources/js/report_view_selection.js', 'public/js')
    .js('resources/js/report_presentation.js', 'public/js')
    .js('resources/js/report_detail.js', 'public/js')
    .js('resources/js/2020/report_detail.js', 'public/js/2020')
    .js('resources/js/2020/report_presentation.js', 'public/js/2020')
    .postCss('resources/css/app.css', 'public/css')
    .postCss('resources/css/list_of_reports.css', 'public/css')
    .postCss('resources/css/report_view_selection.css', 'public/css')
    .postCss('resources/css/report_presentation.css', 'public/css')
    .postCss('resources/css/report_detail.css', 'public/css');
