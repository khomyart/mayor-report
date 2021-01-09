<?php

use Illuminate\Support\Facades\Route;

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
    return view('list_of_reports');
})->name('list_of_reports');

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

#2021
Route::get('/2021', function () {
    return view('reports/2021/report_2021');
})->name('report_2021');

Route::get('/2021/presentation', function () {
    return view('reports/2021/report_2021_presentation');
})->name('report_2021_presentation');

Route::get('/2021/detail', function () {
    return view('reports/2021/report_2021_detail');
})->name('report_2021_detail');
