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

Route::get('/home', function () {
    return redirect('/');
});

Route::get('/', ['uses' => 'HomeController@index', 'as' => 'index']);

Auth::routes();

/*Route::get('post/{slug}', 'PostController@slug');*/

Route::resource('post', 'PostController'/*, ['except' => 'index']*/);

Route::resource('category', 'CategoryController', ['only' => ['create', 'store']]);

Route::group(['prefix' => 'admin', ['middleware' => ['auth', 'admin']]], function () {
    Route::get('/', 'AdminController@index');
});