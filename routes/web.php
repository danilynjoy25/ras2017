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

Route::get('/phpinfo',function () {return view('phpinfo');});

//
Route::get('/userregister',function(){
   return view('userregister');
});

Route::get('/user/register',function(){
   return view('userregister1');
});
Route::post('/user/register',array('uses'=>'UserRegistrationController@postRegister'));

//For testing
Route::get('/test',function(){
   return view('test');
});

//API
Route::post('/api','APIController@receive')->name('api');

Auth::routes();

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::resource('sensors', 'SensorController');

Route::get('dashboard',
  function () {

  $status = App\Http\Controllers\APIController::getSensorData();

  return view('home')->with('status', $status);
  }
);

Route::get('dashboard', 'DashboardController@index')->name('dashboard')->middleware('auth');

//WMS ROUTES
//SUMMARY
Route::get('wms', 'WMSController@summary')->name('wms.summary');
//CHARTS

Route::get('wms/area', 'WMSController@area')->name('wms.area');
Route::get('wms/bar', 'WMSController@bar')->name('wms.bar');

//TABLES

Route::get('wms/tables', 'WMSController@tables')->name('wms.tables');

//DMS ROUTES
Route::get('dms', function () {return view('dms.home');} )->name('dms.home');


Route::get('/', 'HomeController@index')->name('home');

// Route::get('/home',
//   function () {
//
//   $status = App\Http\Controllers\APIController::getSensorData();
//
//   return view('home')->with('status', $status);
//   }
// );

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
