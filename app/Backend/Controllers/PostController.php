<?php

namespace App\Backend\Controllers;

use App\Models\Backend\BackendPost;

class PostController extends Controller {

    public function index() {
        $posts = BackendPost::withoutGlobalScope('avaiable')->where('status', 0)->orderBy('created_at', 'desc')->paginate(15);
        return view('backend.post.index', compact('posts'),['title' => '文章管理']);
    }

    /**
     * @todo 文章审核问题的修复，参测由模型绑定异常和路由错误导致；
     * 
     * @param  Post $post 由路由传过来的参数；
     * 
     * @return json error 错误信息
     */
    public function status(BackendPost $post) {
        $this->validate(request(), [
            'status' => 'required|integer:1,-1'
        ]);
        $post->status = request('status');
        $post->save();
        return [
            'error' => 0,
            'msg' => ''
        ];
    }

}
