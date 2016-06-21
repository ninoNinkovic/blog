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
    Route::model('articles', 'App\Models\Article');

    //--------Route Group without Middleware: Auth-----------------
    Route::get('login', 'AuthController@login');
    Route::get('logout', 'AuthController@logout');

    Route::auth();

    //--------Route Group with Middleware: Auth-----------------
    Route::group(['middleware' => 'auth'], function(){
        Route::get('/', 'WelcomeController@index');

        Route::resource('subjects', 'SubjectsController', ['except' => [
            'show'
        ]]);

        Route::resource('tags', 'TagsController', ['except' => [
            'show'
        ]]);

        Route::resource('articles', 'ArticlesController');

        //--------Users Profile Update-----------------
        Route::get('profile', 'UsersController@profile');
        Route::post('update_profile', 'UsersController@update_profile');

        Route::get('password', 'UsersController@password');
        Route::post('reset_password', 'UsersController@reset_password');

        //--------Route Group with some Administrative Privileges-----------------
        Route::group(['middleware' => 'administrator'], function()
        {
            Route::resource('users', 'UsersController');

            Route::get('tags/trash', 'TagsController@trash');
            Route::post('tags/clean/{id}', 'TagsController@clean');
            Route::post('tags/restore/{id}', 'TagsController@restore');
        });
        
    });
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');