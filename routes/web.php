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
    return view('welcome');
});

Auth::routes();
/*
Route::group(['middleware'=>'verifyuser'],function(){
	Route::get('/home','HomeController@index')->name('home');
});
*///'prefix' => 'v1',

Route::group([ 'middleware' => 'api'], function () {
	Route::get('/home', 'HomeController@index');
    Route::resource('/posts', 'PostController');

	});
  Route::get('verify/{email}/{token}','Auth\RegisterController@activeAccount');