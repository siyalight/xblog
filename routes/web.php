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

Route::get('article/{slug}/', ['uses' => 'PostController@show', 'as' => 'post.show']);
Route::get('post/{post}/restore', ['uses' => 'PostController@restore', 'as' => 'post.restore']);

Route::resource('post', 'PostController', ['except' => 'show']);

Route::resource('category', 'CategoryController', ['only' => ['create', 'store']]);

Route::group(['prefix' => 'admin', ['middleware' => ['auth', 'admin']]], function () {
    Route::get('/', ['uses'=>'AdminController@index','as'=>'admin.index']);
    Route::get('/posts', ['uses'=>'AdminController@posts','as'=>'admin.posts']);
});