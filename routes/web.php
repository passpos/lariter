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
