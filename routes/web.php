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

//文章列表页
Route::get('/posts', 'PostController@index');

//文章详情页
Route::get('/posts/{post}', 'PostController@show')
        ->where('post', '[0-9]+');

//创建、存储文章
Route::get('/posts/create', 'PostController@create');
Route::post('/posts', 'PostController@store');

//编辑、更新文章
Route::get('/posts/{post}/edit', 'PostController@edit')
        ->where('post', '[0-9]+');
Route::put('/posts/{post}', 'PostController@update')
        ->where('post', '[0-9]+');

//上传图片
Route::post('/posts/upload', 'PostController@upload');

//删除文章
Route::get('/posts/delete', 'PostController@delete');
