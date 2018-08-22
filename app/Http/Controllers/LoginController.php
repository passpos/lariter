<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Redirect;

class LoginController extends Controller {

    // 登录页
    public function index() {
        return view('user.login');
    }

    /**
     * 登录行为
     * 
     * 登录行为一般包括：
     * 1. 用户数据库登录检查（认证，这通过Auth::attempt()进行，认证成功会自动为该用
     *   户设置一个认证 Session，标识该用户登录成功）
     * 2. 用户状态维持与检查（）
     */
    public function login(Request $request) {
        // 验证
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8|max:25',
            'is_remember' => 'integer'
        ]);
        // 逻辑
        $email = $request->input('email');
        $password = $request->input('password');

        $is_remember = boolval($request->input('is_remember'));

        if (Auth::attempt(['email' => $email, 'password' => $password], $is_remember)) {
            return redirect('/posts');
        }
        // 渲染
        return Redirect::back()->withErrors('账户与密码不匹配！');
    }

    // 登出行为
    public function logout() {
        Auth::logout();
        return redirect('/posts');
    }

}
