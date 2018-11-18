<?php

/**
 * 后台模块
 */
Route::prefix('backend')->group(function () {

    // 登录页面
    Route::get('login', 'LoginController@show');
    // 登录表单数据处理，登录行为
    Route::post('login', 'LoginController@login');

    // 登出行为
    Route::get('logout', 'LoginController@logout');

    Route::group(['middleware' => 'auth:backend'], function() {
        // 后台首页
        Route::get('index', 'PanelController@index');
        
        // 后台管理人员模块
        Route::get('users','UserController@index');
        // 添加管理人员
        Route::get('users/create','UserController@create');
        // 存储添加的管理人员
        Route::post('users/store','UserController@store');
        
        // 文章审核模块
        Route::get('posts', 'PostController@index');
        Route::post('posts/{status}', 'PostController@status');
    });
});
