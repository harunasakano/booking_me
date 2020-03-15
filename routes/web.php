<?php

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

use App\Http\Controllers\VacantController;

Auth::routes();

Route::get('/', function () {
    return view('top.top');
});

Route::get('user/{id}/vacant/{req_year_month?}','VacantController@index')->where('req_year_month', '\d{4}_\d{2}')->name('year_month_vacant');

Route::resource('user', 'UserController');
Route::resource('user/{id}/vacant', 'VacantController')->middleware('auth');

Route::resource('user/{id}/share_url', 'UserVacantShareUrlController', ['except' => ['show']]);
