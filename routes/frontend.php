<?php

/*
  |--------------------------------------------------------------------------
  | 前台路由
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */


/**
 * 用户模块
 * 
 *   用户注册链接，跳转到注册表单页
 *   注册表单处理
 * 
 *   登录页面
 *   登录表单数据处理，登录行为
 *   登出行为
 * 
 *   个人中心/个人主页
 *   个人空间
 *   个人资料设置
 */
Route::prefix('user')->group(function () {

    Route::get('register', 'RegisterController@index');
    Route::post('register', 'RegisterController@register');

    Route::get('login', 'LoginController@index');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');

    Route::get('homepage/{user}', 'UserController@userHomepage');
    Route::get('field/{user}', 'UserController@userField');
    Route::get('setting', 'UserController@userDetails');
    Route::post('setting', 'UserController@setDetails');

    /**
     * 粉丝与关注
     * 
     *   关注某个用户
     *   取消关注某个用户
     */
    Route::post('focus/{user}', 'UserController@doFocus');
    Route::post('unfocus/{user}', 'UserController@unFocus');
});
