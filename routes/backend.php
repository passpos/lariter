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
    Route::get('', 'LoginController@show');
    Route::get('login', 'LoginController@show')->name('login');;
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');

    /**
     * 后台管理页面与逻辑
     * 
     *   这里的“auth”用于进行登录状态的认证；
     *   实现原理是检查登录后的session会话信息进行认证；
     *     通过在/config/auth.php中创建新的“guard”，其驱动当然是session了；
     *     同时为此guard添加provider，驱动为eloquent，使用的orm模型当然是backenduser了；
     *     此处，从session中取出登录信息，然后与数据表中的用户信息进行比对，实现认证和访问。
     *     如果尚未登录，session中则没有已登录的用户信息；
     * 
     */
    Route::group(['middleware' => 'auth:backend'], function() {

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
        Route::post('roles/store', 'RoleController@store');
        Route::get('roles/permission/{role}', 'RoleController@permission');
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
        Route::post('permissions/store', 'PermissionController@store');

        /**
         * 文章审核模块
         * 
         *   待审核文章列表页
         *   文章审核逻辑
         */
        Route::get('posts', 'PostController@index');
        Route::post('posts/status', 'PostController@status');

        /**
         * 专题管理模块
         */
        Route::get('topics', 'TopicController@index');
        Route::get('topics/create', 'TopicController@create');
        Route::post('topics/store', 'TopicController@store');

        /**
         * 通知管理模块
         */
        Route::get('notices', 'NoticeController@index');
        Route::get('notices/create', 'NoticeController@create');
        Route::post('notices/store', 'NoticeController@store');
    });
});
