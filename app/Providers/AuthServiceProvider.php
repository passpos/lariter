<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Backend\BackendPermission;

class AuthServiceProvider extends ServiceProvider {

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model'                 => 'App\Policies\ModelPolicy',
        'App\Models\Frontend\Post' => 'App\Policies\PostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        $this->registerPolicies();

        /**
         * 取出所有权限；
         * 循环输出权限模型为$permission；
         * 对每一个权限模型（权限的name字段）都定义一个Gate；
         * 
         * 完成上面的任务后，执行一个（包含User对象（$user）的）匿名函数[闭包]；
         * 在匿名函数中，进行权限判断，并返回boolean；
         * 判断的原理仍是ORM模型关联和在User模型中预定义的函数；
         */
        $permissions = BackendPermission::all();
        foreach ($permissions as $permission) {
            Gate::define($permission->name, function($user) use($permission) {
                return $user->hasPermission($permission);
            });
        }
    }

}
