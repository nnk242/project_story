<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Backend

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'HomeController@index')->name('admin');
    Route::get('user', 'UserController@index')->name('user');

    Route::group(['prefix' => 'post'], function () {
        Route::get('/', 'Backend\PostController@index')->name('post');
        Route::get('create', 'Backend\PostController@create')->name('post.create');
        Route::post('postCreate', 'Backend\PostController@postCreate')->name('post.postCreate');
        Route::post('ajaxCreateShortContent', 'Backend\PostController@ajaxCreateShortContent')->name('ajax.createShortContent');
        Route::post('ajaxCreateContent', 'Backend\PostController@ajaxCreateContent')->name('ajax.createContent');
    });
});
