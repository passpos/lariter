<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    
    // 设置页
    public function index() {
        return view('user.setting');
    }

    // 设置行为
    public function setting() {
        
    }

}
