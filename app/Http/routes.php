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
//
//Route::get('/', function () {
//    return view('home');
//});


Route::get('auth/google', 'Auth\AuthController@redirectToProvider');
Route::get('auth/google/callback', 'Auth\AuthController@handleProviderCallback');

Route::get('/', 'Home@home');
Route::get('/new', 'Home@newUI');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//Route::get('/', 'Home@index');

Route::group(['middleware' => ['auth']], function() {

    Route::get('/home', [
        'as' => 'home', 'uses' => 'Home@dashboard'
    ]);

    Route::get('/profile', [
        'as' => 'profile', 'uses' => 'Home@dashboard'
    ]);
    Route::get('/edit', [
        'as' => 'edit', 'uses' => 'Member@editUser'
    ]);

    Route::get('/users', [
        'as' => 'users', 'uses' => 'Member@users'
    ]);

    Route::post('/updateProfile', [
        'as' => 'updateProfile', 'uses' => 'Member@updateProfile'
    ]);

    Route::post('/imageCrop', [
        'as' => 'imageCrop', 'uses' => 'Member@viewImageCrop'
    ]);

    Route::get('/addPost', [
        'as' => 'addPost', 'uses' => 'Post@addPost'
    ]);

    Route::post('/savePost', [
        'as' => 'savePost', 'uses' => 'Post@savePost'
    ]);

    Route::get('/managePost', [
        'as' => 'managePost', 'uses' => 'Post@managePost'
    ]);

    Route::post('/processSetStatus', [
        'as' => 'processSetStatus', 'uses' => 'Post@processSetStatus'
    ]);

    Route::post('/processDeletePost', [
        'as' => 'processDeletePost', 'uses' => 'Post@processDeletePost'
    ]);
	
	Route::post('/processUpdateExpire', [
        'as' => 'processUpdateExpire', 'uses' => 'Post@processUpdateExpire'
    ]);
	
	
});

