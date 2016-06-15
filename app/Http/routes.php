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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'Admin::'], function () {

    //--------Route Resource Model Binding-----------------
    Route::model('subjects', 'App\Models\Subject');
    Route::model('tags', 'App\Models\Tag');
    Route::model('users', 'App\Models\User');

    Route::get('login', 'AuthController@login');
    Route::get('logout', 'AuthController@logout');

    Route::auth();

    Route::group(['middleware' => 'auth'], function(){
        Route::get('/', 'WelcomeController@index');

        Route::resource('subjects', 'SubjectsController', ['except' => [
            'show'
        ]]);

        Route::resource('tags', 'TagsController', ['except' => [
            'show'
        ]]);

        Route::resource('users', 'UsersController');
        
    });
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');
