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
	
	Route::get('/availability', [
		'as' => 'availability',
		'uses' => 'HomeController@getAvailability'
	]);
	
	Route::get('/adminviewavailability', [
	'as' => 'adminviewavailability',
	'uses' => 'HomeController@adminViewAvailability'
	]);

	Route::post('/availability/post', [
		'as' => 'availability.post',
		'uses' => 'AvailabilityController@store'
	]);

	Route::post('/availability/update', [
		'as' => 'availability.update',
		'uses' => 'AvailabilityController@update'
	]);

	Route::get('/users', [
		'as' => 'users',
		'uses' => 'UsersController@index',
	]);

	Route::get('/users/create', [
		'as' => 'users.create',
		'uses' => 'UsersController@create',
	]);

	Route::post('/users/store', [
		'as' => 'users.store',
		'uses' => 'UsersController@store',
	]);

	Route::get('/minor', 'HomeController@minor')->name("minor");

});
