<?php

namespace App\Backend\Controllers;

use App\Models\Backend\BackendRole;
use App\Models\Backend\BackendPermission;

class RoleController extends Controller {

    public function index() {
        $roles = BackendRole::paginate(15);
        $title = '角色管理';
        return view('backend.role.index', compact('roles', 'title'));
    }

    public function create() {
        return view('backend.role.create', ['title' => '创建角色']);
    }

    public function store() {
        $this->validate(request(), [
            'name' => 'required|string|min:3',
            'description' => 'required',
        ]);
        BackendRole::create(request(['name', 'description']));
        return redirect('/backend/roles');
    }

    public function permission(BackendRole $role) {
        $permissions = BackendPermission::all();
        $itsPermissions = $role->permissions;
        $title = '角色 - 权限管理';
        return view('backend.role.permission', compact('permissions', 'itsPermissions', 'role', 'title'));
    }

    /**
     * 
     * @param BackendRole $role
     * @var    $permissions     被执行角色将获得的全部权限（与数据库匹配的权限）；
     * @var    $itsPermissions  被执行角色原有的全部权限；
     * @return type
     */
    public function storePermission(BackendRole $role) {
        $this->validate(request(), [
            'permissions' => 'required|array',
        ]);
        $permissions = BackendPermission::findMany(request('permissions'));
        $itsPermissions = $role->permissions;

        $grantPermissions = $permissions->diff($itsPermissions);
        foreach ($grantPermissions as $grantPermission) {
            $role->grantPermission($grantPermission);
        }

        $withdrawPermissions = $itsPermissions->diff($permissions);
        foreach ($withdrawPermissions as $withdrawPermission) {
            $role->withdrawPermission($withdrawPermission);
        }
        return back();
    }

}
