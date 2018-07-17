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

Route::get('/start', 'StartController@index');
Route::get('/start/get-json', 'StartController@getJSON');
Route::get('/start/data-chart', 'StartController@chartData');
Route::get('/start/random-chart', 'StartController@chartRandom');
Route::get('/start/socket-chart', 'StartController@newEvent');

Route::get('/spa/{any}', 'SpaController@index')->where('any', '.*');

Route::middleware('auth')->prefix('admin')->group(function(){
	Route::get('categories','CategoriesController@index')->name('categories.index');
});
