<?php

namespace App\Backend\Controllers;

use App\Mariadb\Backend\BackendUser;

class UserController extends Controller {

    public function index() {
        $users = BackendUser::paginate(20);
        return view('backend.user.index', ['users' => $users]);
    }

    public function create() {
        return view('backend.user.create');
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

}
