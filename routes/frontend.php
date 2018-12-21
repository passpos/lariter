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
 * 
 *   关注某个用户
 *   取消关注某个用户
 * 
 *   通知
 */
Route::prefix('user')->group(function () {

    Route::get('register', 'RegisterController@index');
    Route::post('register', 'RegisterController@register');

    Route::get('login', 'LoginController@index');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');

    Route::get('detail/{user}', 'UserController@userDetails')->where('user', '[0-9]+');
    Route::get('home/{user}', 'UserController@userHome')->where('user', '[0-9]+');
    Route::get('setting/{user}', 'UserController@setting')->where('user', '[0-9]+');
    Route::post('setting/{user}', 'UserController@storeSetting')->where('user', '[0-9]+');

    Route::post('focus/{user}', 'UserController@doFocus')->where('user', '[0-9]+');
    Route::post('unfocus/{user}', 'UserController@unFocus')->where('user', '[0-9]+');

    Route::get('notices', 'NoticeController@index');
});

// 文章首页、列表页
Route::get('/', 'PostController@index')->name('home');

/**
 * 文章模块
 * 
 *   文章列表页
 *   文章详情页
 * 
 *   创建、存储文章页面
 *   编辑、更新文章
 * 
 *   上传图片
 *   删除文章
 * 
 *   提交评论
 * 
 *   点赞
 *   取消点赞
 * 
 *   文章搜索
 */
Route::prefix('posts')->group(function () {
    Route::get('', 'PostController@index');
    Route::get('{post}', 'PostController@passage')->where('post', '[0-9]+');

    Route::get('create', 'PostController@create');
    Route::get('wangedt', 'PostController@wangEdt');
    Route::get('kedt', 'PostController@kEdt');
    Route::get('nkedt', 'PostController@nkEdt');
    Route::get('nedt', 'PostController@nEdt');
    Route::post('store', 'PostController@store');

    Route::get('edit/{post}', 'PostController@edit')->where('post', '[0-9]+');
    Route::put('store/{post}', 'PostController@update')->where('post', '[0-9]+');

    Route::post('upload/image', 'PostController@uploadImage');
    Route::get('delete/{post}', 'PostController@delete');

    Route::post('comment/{post}', 'PostController@comment');

    Route::get('up/{post}', 'PostController@up');
    Route::get('unup/{post}', 'PostController@unup');

    Route::post('search', 'PostController@search');
});

/**
 * 专题模块
 * 
 *   专题显示
 *   向专题投稿
 */
Route::prefix('topic')->group(function () {
    Route::get('{topic_id}', 'TopicController@show');
    Route::post('publish/{topic_id}', 'TopicController@publish');
});
