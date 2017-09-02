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
        Route::get('edit/{id}', 'Backend\PostController@edit');
        Route::post('postEdit/{id}', 'Backend\PostController@postEdit');
        Route::get('delete/{id}', 'Backend\PostController@delete');
        Route::post('ajaxEditShortContent', 'Backend\PostController@ajaxEditShortContent')->name('ajax.editShortContent');
        Route::post('ajaxEditContent', 'Backend\PostController@ajaxEditContent')->name('ajax.editContent');
        Route::post('ajaxEditStatus', 'Backend\PostController@ajaxEditStatus')->name('ajax.editStatus');
    });
});
