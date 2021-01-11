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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/report_view_selection.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css')
    .postCss('resources/css/list_of_reports.css', 'public/css')
    .postCss('resources/css/report_view_selection.css', 'public/css')
    .postCss('resources/css/report_presentation_view.css', 'public/css')
    .postCss('resources/css/report_detail_info_view.css', 'public/css');


