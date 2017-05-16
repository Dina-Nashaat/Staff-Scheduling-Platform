<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => 'guest'], function() {

	Route::get('/', [
		'as' => 'main',
		'uses' =>'Auth\LoginController@showLoginForm'
	]);

	Route::get('/login', [
		'as' => 'login',
		'uses' =>'Auth\LoginController@showLoginForm'
	]);

	Route::post('/login', [
		'as' => 'login.submit',
		'uses' =>'Auth\LoginController@login'
	]);

});


Route::group(['middleware' => 'auth'], function() {

	Route::get('/logout', [
		'as' => 'logout',
		'uses' => 'Auth\LoginController@logout',
	]);

	Route::get('/home', [
		'as' => 'home',
		'uses' => 'HomeController@index'
	]);

	Route::get('/users', [
		'as' => 'users',
		'uses' => 'UsersController@index',
	]);

	Route::get('/minor', 'HomeController@minor')->name("minor");

});
