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
	
	Route::get('/home', [
				'as' => 'home',
				'uses' => 'HomeController@index',
	]);
	
	Route::get('/logout', [
		'as' => 'logout',
		'uses' => 'Auth\LoginController@logout',
	]);


	Route::get('/availability', [
		'as' => 'availability',
		'uses' => 'HomeController@getAvailability',
		'middleware' => 'permissions',
		'permissions' => ['get_availability'],
	]);

	Route::post('/availability/post', [
		'as' => 'availability.post',
		'uses' => 'AvailabilityController@store',
		'middleware' => 'permissions',
		'permissions' => ['set_availability'],
	]);

	Route::post('/availability/update', [
		'as' => 'availability.update',
		'uses' => 'AvailabilityController@update',
		'middleware' => 'permissions',
		'permissions' => ['set_availability'],
	]);

	Route::get('/availability/fetch', [
		'as' => 'availability.fetch',
		'uses' => 'AvailabilityController@fetch',
		'middleware' => 'permissions',
		'permissions' => ['get_availability'],
	]);

	Route::post('/availability/delete', [
		'as' => 'availability.delete',
		'uses' => 'AvailabilityController@delete',
		'middleware' => 'permissions',
		'permissions' => ['delete_availability'],
	]);

	Route::get('/availability/view', [
		'as' => 'availability.view',
		'uses' => 'AvailabilityController@view',
		'middleware' => 'permissions',
		'permissions' => ['get_availability_all'],
	]);

	Route::get('/availability/get', [
		'as' => 'availability.get',
		'uses' => 'AvailabilityController@get',
		'middleware' => 'permissions',
		'permissions' => ['get_availability_all'],
	]);

	Route::post('/availability/get', [
		'as' => 'availability.post',
		'uses' => 'AvailabilityController@get',
		'middleware' => 'permissions',
		'permissions' => ['get_availability_all'],
	]);

	Route::get('/availability/availableAtTime', [
		'as' => 'availability.availableAtTime',
		'uses' => 'AvailabilityController@availableAtTime',
		'middleware' => 'permissions',
		'permissions' => ['get_availability_all'],
	]);

	Route::post('/availability/availableAtTime', [
		'as' => 'availability.availableAtTime',
		'uses' => 'AvailabilityController@availableAtTime',
		'middleware' => 'permissions',
		'permissions' => ['get_availability_all'],
	]);


	Route::get('/schedule', [
		'as' => 'schedule',
		'uses' => 'ScheduleController@getSchedule',
		'middleware' => 'permissions',
		'permissions' => ['get_schedule'],
	]);

	Route::post('/schedule/post', [
		'as' => 'schedule.post',
		'uses' => 'ScheduleController@store',
		'middleware' => 'permissions',
		'permissions' => ['add_event'],
	]);

	Route::get('/schedule/fetch', [
		'as' => 'schedule.fetch',
		'uses' => 'ScheduleController@fetch',
		'middleware' => 'permissions',
		'permissions' => ['get_schedule_all'],
	]);

	Route::post('/schedule/update', [
		'as' => 'schedule.update',
		'uses' => 'ScheduleController@update',
		'middleware' => 'permissions',
		'permissions' => ['edit_event'],
	]);

	Route::post('/schedule/assign', [
		'as' => 'schedule.assignPost',
		'uses' => 'ScheduleController@assign',
		'middleware' => 'permissions',
		'permissions' => ['assign_staff'],
	]);
	
	Route::post('/schedule/checkIfUserScheduled', [
	'as' => 'schedule.checkIfUserScheduled',
	'uses' => 'ScheduleController@checkIfUserScheduled',
	'middleware' => 'permissions',
	'permissions' => ['get_schedule'],
	]);

	Route::post('/schedule/getScheduled', [
	'as' => 'schedule.getScheduled',
	'uses' => 'ScheduleController@getScheduled',
	'middleware' => 'permissions',
	'permissions' => ['get_schedule'],
	]);

	Route::post('/schedule/delete', [
		'as' => 'schedule.delete',
		'uses' => 'ScheduleController@delete',
		'middleware' => 'permissions',
		'permissions' => ['delete_event'],
	]);

	Route::get('/users', [
		'as' => 'users',
		'uses' => 'UsersController@index',
		'middleware' => 'permissions',
		'permissions' => ['view_users'],
	]);

	Route::get('/users/create', [
		'as' => 'users.create',
		'uses' => 'UsersController@create',
		'middleware' => 'permissions',
		'permissions' => ['add_user'],
	]);

	Route::post('/users/store', [
		'as' => 'users.store',
		'uses' => 'UsersController@store',
		'middleware' => 'permissions',
		'permissions' => ['add_user'],
	]);

	Route::get('/users/edit/{userId}', [
		'as' => 'users.edit',
		'uses' => 'UsersController@edit',
		'middleware' => 'permissions',
		'permissions' => ['edit_user'],
	]);
	
	Route::get('/minor', 'HomeController@minor')->name("minor");
});
