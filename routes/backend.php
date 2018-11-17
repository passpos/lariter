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

    // 后台首页
    Route::get('index', 'PanelController@index');
});
