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

//user
Route::resource('user', 'UserController')->middleware('auth');

//空き日月日の表示 注：空き日routingより下にこのroutingを持っていくと動かなくなります。
Route::get('user/{id}/vacant/{req_year_month?}','VacantController@index')->where('req_year_month', '\d{4}_\d{2}')->name('year_month_vacant')->middleware('auth');

//空き日
Route::resource('user/{id}/vacant', 'VacantController')->middleware('auth');

//共有用URL
Route::resource('user/{id}/share_url', 'UserVacantShareUrlController', ['except' => ['show','edit','update']])->middleware('auth');

//ゲストが特定の共有用URLから空き日を閲覧するURL
//マッチする条件とミドルウェアを書く認証が通ったら、セッションにuser情報を格納する
Route::get('guest/{param}', 'BookingController@browse');

//Route::resource('guest', 'BookingController');
