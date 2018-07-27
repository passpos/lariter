<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller {

    // 文章列表
    public function index() {
        $posts = Post::paginate(5);
        return view('post.index', ['posts' => $posts]);
    }

    //文章详情
    public function show(Post $post) {
        return view('post.show', ['posts' => $post]);
    }

    //创建文章
    public function create() {
        return view('post.create');
    }

    /**
     * 存储文章
     * 
     * 表单提交三步骤：
     * ①验证
     * ②逻辑（传递数据到数据表模型的方法）
     * ③渲染
     */
    public function store() {
        // 从请求中获取所有数据的方法：Request::all()，
        // 或下面的request()方法，这是由Request门面对象提供的
        // 需要指明传来的具体参数可在括号内注明，
        // 留空表示获取所有内容
        // 验证
        $this->validate(request(), [
            'title' => 'required|string|max:100|min:4',
            'content' => 'required|string|max:7000|min:100',
        ]);
        // 逻辑
        $post = new Post();
        $post->title = request('title');
        $post->content = request('content');
        $post->save();
        // 用下面的代码一样可以实现写入文章到数据库
        // $params = ['title' => request('title'), 'content' => request('content')];
        // 或直接传递request()的参数数组
        // $params = request(['title', 'content']);
        // Post::create($params);
        // 即
        // Post::create($request(['title', 'content']));
        // 渲染提交后的页面
        return redirect("/posts");
    }

    //编辑文章
    public function edit() {
        return view('post.');
    }

    //更新文章
    public function update() {
        
    }

    //上传图片
    public function upload() {
        $path = $request
                ->file('wangEditorH5File')
                ->storePublicly(md5(time()));
        return asset('storage/'.$path);
    }

    //删除文章
    public function delete() {
        
    }

}
