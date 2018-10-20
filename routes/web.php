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

// 文章首页、列表页
Route::get('/', 'PostController@index');

/**
 * 文章模块
 */
Route::prefix('posts')->group(function () {
    //文章列表页
    Route::get('', 'PostController@index');
    //文章详情页
    Route::get('{post}', 'PostController@passage')->where('post', '[0-9]+');

    //创建、存储文章
    Route::get('create', 'PostController@create');
    Route::post('store', 'PostController@store');
    //编辑、更新文章
    Route::get('edit/{post}', 'PostController@edit')->where('post', '[0-9]+');
    Route::put('store/{post}', 'PostController@update')->where('post', '[0-9]+');
    //删除文章
    Route::get('delete/{post}', 'PostController@delete');

    //上传图片
    Route::post('upload/image', 'PostController@uploadImage');

    // 提交评论
    Route::post('comment/{post}', 'PostController@comment');

    // 点赞
    Route::get('up/{post}', 'PostController@up');
    // 取消点赞
    Route::get('unup/{post}', 'PostController@unup');
});

/**
 * 用户模块
 */
Route::prefix('user')->group(function () {

    // 用户注册链接，跳转到注册表单页
    Route::get('register', 'RegisterController@index');
    // 注册表单处理
    Route::post('register', 'RegisterController@register');

    // 登录页面
    Route::get('login', 'LoginController@index');
    // 登录表单数据处理，登录行为
    Route::post('login', 'LoginController@login');

    // 登出行为
    Route::get('logout', 'LoginController@logout');

    // 个人中心/个人主页
    Route::get('homepage/{user}', 'UserController@userHomepage');
    // 个人空间
    Route::get('field/{user}', 'UserController@userField');

    // 个人资料设置
    Route::get('setting', 'UserController@userDetails');
    Route::post('setting', 'UserController@setDetails');

    /**
     * 粉丝与关注
     * 
     * 关注某个用户
     */
    Route::post('focus/{user}', 'UserController@doFocus');
    // 取消关注某个用户
    Route::post('unfocus/{user}', 'UserController@unFocus');
});