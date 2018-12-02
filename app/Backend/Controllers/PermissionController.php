<?php

namespace App\Backend\Controllers;

use App\Mariadb\Backend\BackendPermission;

class PermissionController extends Controller {

    //
    public function index() {
        $permissions = BackendPermission::paginate(15);
        $title = '权限管理';
        return view('backend.permission.index', compact('permissions', 'title'));
    }

    public function create() {
        return view('backend.permission.create', ['title' => '增加权限']);
    }

    public function store() {
        $this->validate(request(), [
            'name' => 'required|string',
            'description' => '',
        ]);
        BackendPermission::create(request(['name', 'description']));
        return redirect('backend/permissions');
    }

}
