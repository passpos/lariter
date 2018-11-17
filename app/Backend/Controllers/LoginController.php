<?php

namespace App\Backend\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller {

    public function show() {
        return view('backend.login.show');
    }

    public function login(Request $request) {
        // 验证
        $this->validate($request, [
            'name' => 'required|min:2',
            'password' => 'required|min:5|max:25',
        ]);
        // 逻辑
        $name = $request->input('name');
        $password = $request->input('password');

        if (Auth::guard('backend')->attempt(['name' => $name, 'password' => $password])) {
            return redirect('/backend/index');
        }
        // 渲染
        return Redirect::back()->withErrors('账户与密码不匹配！');
    }

    public function logout() {
        Auth::guard('backend')->logout();
        return redirect('/backend/login');
    }

}
