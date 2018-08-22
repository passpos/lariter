<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller {

    // 注册页
    public function index() {
        return view('user.register');
    }

    /**
     * 注册行为
     * 
     * 注册行为是来自客户行为的数据库操作
     * 这总是涉及到：
     * 1.验证
     * 2.逻辑
     * 3.渲染
     */
    public function register(Request $request) {
        // 验证（验证的数据是来自客户输入的数组）
        $this->validate($request, [
            'name' => 'required|min:3|max:25|unique:users,name',
            'email' => 'required|email|unique:users,email|',
            'password' => 'required|confirmed|min:8|max:25',
        ]);
        // 逻辑
        $name = $request->input('name');
        $email = $request->input('email');

        // 加密前：
        // $password = $request->input('password');
        // 加密后：
        $password = Hash::make($request->input('password'));

        $user = User::create(compact('name', 'email', 'password'));

        return redirect('/user/login');
    }

}
