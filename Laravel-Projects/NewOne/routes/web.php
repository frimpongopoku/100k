<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

|*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/do-things','Conti@addThings');
Route::get('/so',function(){
	return "gengy3";
});
Route::get('/cat',function(){
	Session::get('something');
});

Route::get('/add-cat','Conti@new');
Route::get('/show',function(){
	return "I am a very good by";
});
Route::get('/ret',"Conti@try");
