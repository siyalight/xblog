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


Route::get('/', ['uses' => 'HomeController@index', 'as' => 'index']);

Auth::routes();

Route::get('post/{slug}/', ['uses' => 'PostController@show', 'as' => 'post.show']);
Route::get('post/{post}/restore', ['uses' => 'PostController@restore', 'as' => 'post.restore']);
Route::get('/{name}/', ['uses' => 'PageController@show', 'as' => 'page.show']);


Route::group(['prefix' => 'admin', ['middleware' => ['auth', 'admin']]], function () {

    Route::resource('post', 'PostController', ['except' => ['show', 'index']]);
    Route::resource('category', 'CategoryController', ['only' => ['create', 'store']]);
    Route::resource('page', 'PageController', ['except' => ['show', 'index']]);


    Route::get('/index', ['uses' => 'AdminController@index', 'as' => 'admin.index']);
    Route::get('/posts', ['uses' => 'AdminController@posts', 'as' => 'admin.posts']);
    Route::get('/tags', ['uses' => 'AdminController@tags', 'as' => 'admin.tags']);
    Route::get('/users', ['uses' => 'AdminController@users', 'as' => 'admin.users']);
    Route::get('/pages', ['uses' => 'AdminController@pages', 'as' => 'admin.pages']);
    Route::get('/categories', ['uses' => 'AdminController@categories', 'as' => 'admin.categories']);
});