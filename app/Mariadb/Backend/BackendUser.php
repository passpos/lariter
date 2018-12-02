<?php

namespace App\Mariadb\Backend;

use Illuminate\Foundation\Auth\User as Authenticatable;

class BackendUser extends Authenticatable {

    protected $table = 'backend_users';
    protected $primaryKey = 'id';
    protected $rememberTokenName = '';
    protected $fillable = ['name', 'password'];

    /**
     * 用户有哪些角色=====用户关联角色
     *   当前模型“用户”->$this实例化，应用（关联）到一个或多个角色；
     * 
     * withTimestamps()
     *   多对多关联中，通过User模型访问中间表User-Role，需要加上此方法，才会自动维护时间戳；
     */
    public function roles() {
        return $this->belongsToMany('App\Mariadb\Backend\BackendRole', 'backend_user_role', 'user_id', 'role_id')->withTimestamps();
    }

    /**
     * 判断一个用户（是否）有某个角色身份
     * 
     * @param     array        $role   BackendRole模型的colection，角色模型对象；
     * @return    boolean      返回布尔值；
     * @function  intersect()  集合(结果集，collection)辅助函数，由$roles参数进行调用，返回集合的交集；
     * 
     */
    public function isInRoles($role) {
        return !!$role->intersect($this->role)->count()->withPivot([
                    'user_id',
                    'role_id'
        ]);
    }

    /**
     * 给用户分配角色
     * 
     * @param string $role 要分配给用户的角色信息；
     */
    public function asRole($role) {
        return $this->roles()->save($role);
    }

    /**
     * 取消给用户分配的某个角色
     *   这个取消动作是通过上面定义的 ORM 关联关系roles()方法来实现。
     * 
     * @param string $role Description
     */
    public function dimissionRole($role) {
        return $this->roles()->detach($role);
    }

    /**
     * 判断用户是否有某些“权限”；
     *  判断方法：
     *    通过判断拥有该权限的角色，是否是当前用户所拥有的角色;
     *    $permission->roles，拥有该权限的角色;
     *    此处应由permission模型调用roles方法；
     *    
     */
    public function hasPermission($permission) {
        return $this->isInRoles($permission->roles);
    }

}
