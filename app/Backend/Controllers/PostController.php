<?php

namespace App\Backend\Controllers;

use App\Mariadb\Backend\Post;

class PostController extends Controller {

    public function index() {
        $posts = Post::withoutGlobalScope('avaiable')->where('status', 0)->orderBy('created_at', 'desc')->paginate(15);
        return view('backend.post.index', compact('posts'));
    }

    public function status(Post $post) {
        $this->validate(request(), [
            'post_id' => 'required|integer',
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
