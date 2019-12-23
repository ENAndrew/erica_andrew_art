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

Route::get('/digital', 'HomeController@digital')->name('digital');
Route::get('/traditional', 'HomeController@traditional')->name('traditional');
Route::get('/design', 'HomeController@design')->name('design');

Route::get('/contact', 'HomeController@contact')->name('contact');
Route::post('/contact', 'HomeController@processContact')->name('process.contact');

Route::get('/thanks', 'HomeController@thanks')->name('thanks');

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function() {
	Route::get('/', 'HomeController@dashboard')->name('dashboard');

	Route::post('images/order', 'ImageController@updateOrder');
	Route::resource('images', 'ImageController');

	Route::resource('image-types', 'ImageTypeController');

	Route::resource('users', 'UserController');
});
