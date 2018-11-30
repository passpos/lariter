<?php

namespace App\Backend\Controllers;

class RoleController extends Controller {

    public function index() {
        return view('backend.role.index',['title' => '角色管理']);
    }

    public function create() {
        return view('backend.role.create',['title' => '创建角色']);
    }

    public function store() {
        
    }

    public function permission() {
        return view('backend.role.permission',['title' => '角色 - 权限管理']);
    }

    public function storePermission() {
        
    }

}
