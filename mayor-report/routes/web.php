<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Reports;

use App\Models\Report;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('list_of_reports', ['reports' => Report::orderByDesc('published_at')->where('deleted_at', NULL)->get()->toArray()]);
})->name('list_of_reports');

Route::get('/report/{year}', function($year) {
    $report = Report::where('year', $year)->get()->first();
    return view('report', ['year' => $year, 'bookUrl' => $report->reportBook["path_to_report_book"]]);
})->name('report');

Route::get('/report/{year}/detail', [Reports::class, 'showReportDetail'])
->name('report_detail');

Route::get('/report/{year}/presentation', [Reports::class, 'showReportPresentation'])
->name('report_presentation');

//AWAY
Route::get('/control', function() {
    return redirect()->away(env('ADMIN_PANEL_URL'));
});


#2020
Route::get('/2020', function () {
    return view('reports/2020/report_2020');
})->name('report_2020');

Route::get('/2020/presentation', function () {
    return view('reports/2020/report_2020_presentation');
})->name('report_2020_presentation');

Route::get('/2020/detail', function () {
    return view('reports/2020/report_2020_detail');
})->name('report_2020_detail');
