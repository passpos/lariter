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

/**
 * 文章模块
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
Route::post('/posts/upload/image', 'PostController@uploadImage');

//删除文章
Route::get('/posts/{post}/delete', 'PostController@delete');






/**
 * 用户模块
 * 
 */

//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
//

// 用户注册链接，跳转到注册表单页
Route::get('/user/register','RegisterController@index');
// 注册表单处理
Route::post('/user/register','RegisterController@register');

// 个人资料设置页面
Route::get('/user/setting','UserController@index');
Route::post('/user/setting','UserController@setting');



// 登录页面
Route::get('/user/login','LoginController@index');
// 登录表单数据处理，登录行为
Route::post('/user/login','LoginController@login');
// 登出行为
Route::get('/user/logout','LoginController@logout');