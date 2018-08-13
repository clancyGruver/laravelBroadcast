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

Route::get('/', 'HomeController@index');

Route::prefix('start')->group(function(){
	Route::get('', 'StartController@index');
	Route::get('/get-json', 'StartController@getJSON');
	Route::get('/data-chart', 'StartController@chartData');
	Route::get('/random-chart', 'StartController@chartRandom');
	Route::get('/socket-chart', 'StartController@newEvent');
	Route::get('/send-message', 'StartController@sendMessage');
});

Route::get('/spa/{any}', 'SpaController@index')->where('any', '.*');
Route::post('/sendmesasage', 'SpaController@sendmessage')->name('sendmesasage');

Route::middleware('auth')->prefix('admin')->group(function(){
	Route::get('categories','CategoriesController@index')->name('categories.index');
});
