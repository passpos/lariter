<?php

namespace App\Mariadb\Backend;

use App\Mariadb\Model;

class BackendRole extends Model {

    protected $table = 'backend_roles';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description'];

    /**
     * 角色有哪些权限======角色关联权限
     * 
     * @return relationship
     */
    public function permissions() {
        return $this->belongsToMany('App\Mariadb\Backend\BackendPermission', 'backend_role_permission', 'role_id', 'permission_id')
                        ->withPivot('role_id', 'permission_id')->withTimestamps();
    }

    /**
     * 给（某个）角色赋予权限
     * 
     */
    public function grantPermission($permission) {
        return $this->permissions()->save($permission);
    }

    /**
     * 收回赋予某个角色的权限
     * 
     */
    public function withdrawPermission($permission) {
        return $this->permissions()->detach($permission);
    }

    /**
     * 判断角色是否拥有某个权限；
     * 
     */
    public function hasPermission($permisssion) {
        return $this->permissions()->contains($permisssion);
    }

}
