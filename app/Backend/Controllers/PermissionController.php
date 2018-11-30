<?php

namespace App\Backend\Controllers;

class PermissionController extends Controller
{
    //
    public function index() {
        return view('backend.permission.index',['title' => '权限管理']);
    }
    
    public function create() {
        return view('backend.permission.create',['title' => '增加权限']);
    }
    
    public function store() {
        
    }
}
