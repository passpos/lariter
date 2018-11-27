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
    
    // 文章搜索
    Route::post('search', 'PostController@search');
    
});

/**
 * 专题模块
 *   专题显示
 *   向专题投稿
 */
Route::prefix('topic')->group(function () {
    Route::get('{topic_id}', 'TopicController@show');
    Route::post('publish/{topic_id}', 'TopicController@publish');
});
