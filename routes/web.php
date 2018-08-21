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
Route::prefix('posts')->group(function () {
    //文章列表页
    Route::get('', 'PostController@index');

    //文章详情页
    Route::get('{post}', 'PostController@show')
            ->where('post', '[0-9]+');

    //创建、存储文章
    Route::get('create', 'PostController@create');
    Route::post('', 'PostController@store');

    //编辑、更新文章
    Route::get('{post}/edit', 'PostController@edit')
            ->where('post', '[0-9]+');
    Route::put('{post}', 'PostController@update')
            ->where('post', '[0-9]+');
    //删除文章
    Route::get('{post}/delete', 'PostController@delete');

    //上传图片
    Route::post('upload/image', 'PostController@uploadImage');


});

/**
 * 用户模块
 */
Route::prefix('user')->group(function () {
    //Auth::routes();
    //Route::get('/home', 'HomeController@index')->name('home');

    // 用户注册链接，跳转到注册表单页
    Route::get('register', 'RegisterController@index');
    // 注册表单处理
    Route::post('register', 'RegisterController@register');

    // 个人资料设置页面
    Route::get('setting', 'UserController@index');
    Route::post('setting', 'UserController@setting');


    // 登录页面
    Route::get('login', 'LoginController@index');
    // 登录表单数据处理，登录行为
    Route::post('login', 'LoginController@login');

    // 登出行为
    Route::get('logout', 'LoginController@logout');
});
