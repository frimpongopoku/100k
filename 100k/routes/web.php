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
Route::get('login/google', 'Auth\LoginController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');
//---------
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/auth.get','Main@returnUser');
Route::get('/get-token','Main@getToken');
Route::post('/user.scanned','Main@saveScannedData');
Route::get('/get-count', 'Main@collectTreeData');
Route::get('/factory','Main@testFactory');
Route::get('/count.planted','Main@countPlanted');
