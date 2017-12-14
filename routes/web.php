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

//RAS2017 ROUTES
Route::get('/', function () {
    return view('common.home');
});

//WMS ROUTES
Route::get('wms', 'WMSController@summary');

Route::get('wms/charts', 'WMSController@chart');

Route::get('wms/tables', 'WMSController@tables');

//DMS ROUTES
Route::get('dms', function () {
    return view('dms.home');
});

//Laravel default routes
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//TEST ROUTES
Route::get('/test', function () {
    return view('common.test');
});
