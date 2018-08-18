<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller {

    // 注册页
    public function index() {
        return view('user.register');
    }

    // 注册行为
    public function login() {
        
    }
    
    // 登出行为
    public function logout() {
        
    }

}
