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

//OAUTH 
Route::get('login/{auth}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{auth}/callback', 'Auth\LoginController@handleProviderCallback');
//---------
Route::get('/', function () {
    return view('new-theme');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/auth.get','Main@returnUser');
Route::get('/get-token','Main@getToken');
Route::post('/user.scanned','Main@saveScannedData');
Route::get('/get-count', 'Main@collectTreeData');
Route::get('/factory','Main@testFactory');
Route::get('/count.planted','Main@countPlanted');
Route::get('/qr.generate','Main@generateQR');
Route::get('/home',function(){
  return view('new-theme');
});
Route::get('subscribe','Main@subscribe')->name('subscribe');
Route::get('policy','Main@policy');