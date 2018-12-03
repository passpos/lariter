<?php

namespace App\Mariadb\Backend;

use App\Mariadb\Model;

class BackendPermission extends Model {

    protected $table = 'backend_permissions';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description'];

    /**
     * 权限被赋予给了哪些角色======权限关联角色
     *      一对多（反向）
     * 
     * @return relationship 返回关联关系模型；
     */
    public function roles() {
        return $this->belongsToMany('App\Mariadb\Backend\BackendRole', 'backend_role_permission', 'permission_id', 'role_id')
                        ->withPivot(['permission_id','role_id']);
    }

}
