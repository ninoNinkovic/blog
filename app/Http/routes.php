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

    Route::get('login', 'AuthController@login');
    Route::get('logout', 'AuthController@logout');

    Route::auth();

    Route::group(['middleware' => 'auth'], function(){
        Route::get('/', 'WelcomeController@index');

        Route::resource('tags', 'TagsController');
        /*
        Route::get('dashboard', ['as' => 'dashboard', function () {
            // Route named "admin::dashboard"
        }]);


        Route::resource('article', 'ArticleController');
        Route::resource('gallery', 'GalleryController');
        Route::resource('user', 'UserController');
*/
        // ...
    });
});

Route::get('/', function () {
    return view('welcome');
});



Route::get('/home', 'HomeController@index');
