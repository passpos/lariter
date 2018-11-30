<?php

/**
 * 后台模块
 */
Route::prefix('backend')->group(function () {

    /**
     * 后台登录、登出
     * 
     *   登录页面
     *   登录表单数据处理，登录行为
     *   登出行为
     */
    Route::get('login', 'LoginController@show');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');

    Route::group(['middleware' => 'auth:backend'], function() {
        /**
         * 后台首页
         */
        Route::get('', 'PanelController@index');
        Route::get('index', 'PanelController@index');

        /**
         * 后台管理人员模块
         * 
         *   管理人员列表页
         *   添加管理人员
         *   存储添加的管理人员
         *   用户的角色与职位管理页面
         *   用户的角色与职位管理逻辑
         */
        Route::get('users', 'UserController@index');
        Route::get('users/create', 'UserController@create');
        Route::post('users/store', 'UserController@store');
        Route::get('users/role/{user}', 'UserController@role');
        Route::post('users/role/{user}', 'UserController@storeRole');

        /**
         * 角色与职位管理模块
         * 
         *   角色列表页
         *   角色创建页
         *   角色创建逻辑
         *   角色的权限详情页面
         *   角色的权限管理逻辑
         */
        Route::get('roles', 'RoleController@index');
        Route::get('roles/create', 'RoleController@create');
        Route::post('roles/create', 'RoleController@store');
        Route::get('roles/permission', 'RoleController@permission');
        Route::post('roles/permission/{role}', 'RoleController@storePeimission');
        
        /**
         * 权限管理模块
         * 
         *   权限列表页面
         *   权限创建页面
         *   权限创建逻辑
         */
        Route::get('permissions', 'PermissionController@index');
        Route::get('permissions/create', 'PermissionController@create');
        Route::post('permissions', 'PermissionController@store');
        
        /**
         * 文章审核模块
         * 
         *   待审核文章列表页
         *   文章审核逻辑
         */
        Route::get('posts', 'PostController@index');
        Route::post('posts/status', 'PostController@status');
        
    });
});
