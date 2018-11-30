<?php

namespace App\Backend\Controllers;

use App\Mariadb\Backend\BackendUser;

class UserController extends Controller {

    public function index() {
        $users = BackendUser::paginate(20);
        return view('backend.user.index', ['users' => $users, 'title' => '用户管理']);
    }

    public function create() {
        return view('backend.user.create',['title' => '添加用户']);
    }

    public function store() {
        $this->validate(request(), [
            'name' => 'required|min:3',
            'password' => 'required|min:3',
        ]);
        $name = request('name');
        $password = bcrypt(request('password'));
        BackendUser::create(compact('name', 'password'));
        return redirect("/backend/users" );
    }

    public function role() {
        return view('backend.user.role',['title' => '用户角色管理']);
    }
    
    public function storeRole() {
        
    }
}
