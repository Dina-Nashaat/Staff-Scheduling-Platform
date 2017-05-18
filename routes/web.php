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

	Route::post('/availability/post', [
		'as' => 'availability.post',
		'uses' => 'AvailabilityController@store'
	]);

	Route::post('/availability/update', [
		'as' => 'availability.update',
		'uses' => 'AvailabilityController@update'
	]);

	Route::get('/availability/fetch', [
		'as' => 'availability.fetch',
		'uses' => 'AvailabilityController@fetch'
	]);

	Route::post('/availability/delete', [
		'as' => 'availability.delete',
		'uses' => 'AvailabilityController@delete'
	]);

	Route::get('/availability/view', [
		'as' => 'availability.view',
		'uses' => 'AvailabilityController@view',
	]);

	Route::get('/availability/get', [
		'as' => 'availability.get',
		'uses' => 'AvailabilityController@get',
	]);

	Route::post('/availability/get', [
		'as' => 'availability.post',
		'uses' => 'AvailabilityController@get',
	]);

	Route::get('/schedule', [
		'as' => 'availability',
		'uses' => 'ScheduleController@getSchedule'
	]);

	Route::post('/schedule/post', [
		'as' => 'schedule.post',
		'uses' => 'ScheduleController@store'
	]);

	Route::get('/schedule/fetch', [
		'as' => 'schedule.fetch',
		'uses' => 'ScheduleController@fetch'
	]);

	Route::post('/schedule/update', [
		'as' => 'schedule.update',
		'uses' => 'ScheduleController@update'
	]);

	Route::post('/schedule/delete', [
		'as' => 'schedule.delete',
		'uses' => 'ScheduleController@delete'
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
