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

Auth::routes();
Route::get('/register', 'Auth\RegisterController@abort')->name('register');
Route::post('/register', 'Auth\RegisterController@abort')->name('register.post');

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function() {
	Route::get('/', 'HomeController@dashboard')->name('dashboard');
});
