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

Route::get('/', function () {
    return view('common.home');
});
Route::get('wms', 'WMSController@summary');

Route::get('wms/charts', 'WMSController@chart'); 

Route::get('wms/tables', 'WMSController@tables');

Route::get('dms', function () {
    return view('dms.home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
