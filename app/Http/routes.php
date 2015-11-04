<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// User display
Route::get('members','UserController@index');
Route::get('user/{user_id}', 'UserController@show');
Route::get('user/{user_id}/edit','UserController@edit');
Route::put('user/{user_id}','UserController@update');

// Board displays
Route::get('/', 'ForumController@index');
Route::get('forum/{id}', 'ForumController@show');

// Thread display and creation
Route::get('thread/{id}','ThreadController@show');
Route::get('thread/{forum_id}/create','ThreadController@create');
Route::post('thread','ThreadController@store');

// Post display and creation
Route::resource('post','PostController',['except'=>['create']]);
Route::get('post/{thread_id}/create','PostController@create');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

