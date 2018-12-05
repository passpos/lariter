<?php

namespace App\Frontend\Controllers;

use App\Mariadb\Frontend\Post;
use App\Mariadb\Frontend\Comment;
use App\Mariadb\Frontend\Up;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {

    // 文章列表
    public function index() {
        /**
         * 评论数统计与渲染
         */
        $posts = Post::orderBy('created_at', 'desc')
                ->withCount(['comments', 'ups'])
                ->paginate(5);
        return view('frontend.post.index', ['posts' => $posts]);
    }

    //文章详情
    public function passage(Post $post) {
        // 提前在控制器中加载评论数据；
        // 此处加载后，模板渲染的评论数据就是这里的，不会再次加载。
        $post->load('comments');
        $title = $post->title;
        $author = $post->user->name;
        $postid = $post->id;
        return view('frontend.post.passage', [
            'post' => $post,
            'title' => $title,
            'author' => $author,
            'postid' => $postid
        ]);
    }

    //创建文章
    public function create() {
        return view('frontend.post.create', ['title' => '创作一篇文章!']);
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
        // 需要指明传来的某个具体参数可在括号内注明，
        // 留空表示获取所有内容
        // 验证
        $this->validate(request(), [
            'title' => 'required|string|max:100|min:4',
            'content' => 'required|string|max:50000|min:100',
        ]);

        /**
         * 逻辑
         * 
         * 这里的文章存储逻辑包括了：
         * ①来自用户请求的文章数据调用模型方法进行存储；
         * ②获取用户ID进行逻辑行为的权限验证（由于用户ID是使用Auth验证登陆后产生的Session_id，
         *  所以，用户ID的获取就和Auth紧密相关）
         * 
         * 文章存储方法：
         * create()接收的参数是一个数组；
         * compact()方法的使用前提是，以数组形式输出到某个对象时，变量名应等于键名。
         *  php compact函数用于创建数组，compact函数的参数将接受一个或多个变量，然
         * 后将变量的名称作为该创建 数组的“索引”，变量值作为该创建 数组的值，然后
         * 返回创建完成的数组。
         * 
         * 1) 通过原始的实例化Post数据模型类方法进行存储；
         * $post = new Post();
         * $post->title = request('title');
         * $post->content = request('content');
         * $post->save();
         * 
         * 2) 或直接传递request()的参数数组：
         * Post::create(request(['title', 'content']));
         * 
         * 3) 用下面的代码一样可以实现写入文章到数据库，建议使用此方法；
         * $params = ['title' => request('title'), 'content' => request('content'),'user_id' => $user_id];
         * 下面使用compact()方法表示后略简单些：
         * $params = array_merge(request(['title', 'content']), compact('user_id'));
         * Post::create($params);
         */
        $user_id = Auth::id();
        $params = array_merge(request(['title', 'content']), compact('user_id'));

        Post::create($params);


        // 渲染提交后的页面
        return redirect("/posts");
    }

    // 编辑文章
    public function edit(Post $post) {
        return view('frontend.post.edit', compact('post'), ['title' => $post->title]);
    }

    // 更新文章
    public function update(Post $post) {
        // 验证
        $this->validate(request(), [
            'title' => 'required|string|max:100|min:4',
            'content' => 'required|string|max:15000|min:100',
        ]);
        $this->authorize('update', $post);
        // 逻辑
        $post->title = request('title');
        $post->content = request('content');
        $post->save();
        // 渲染
        return redirect("/posts/{$post->id}");
    }

    /**
     * 图片上传与路径返回
     * 
     * TODO：上传图片，返回文本编辑器相应的图片链接
     */
    public function uploadImage(Request $request) {

        if ($request->hasFile('filename') && $request->file('filename')->isValid()) {
            $photo = $request->file('filename');
            $extension = $photo->extension();

            $store_result = $photo->store('usrimg');
            $output = [
                'extension' => $extension,
                'store_result' => $store_result
            ];
            print_r($output);
            exit();
        }
        exit('未获取到上传文件或上传过程出错');
        return asset('storage/' . 'mbkgf');
    }

    // 删除文章
    public function delete(Post $post) {
        // TODO:这里应该添加用户的权限认证
        $post->delete();
        return redirect("/posts");
    }

    // 提交评论文章
    public function comment(Post $post) {

        // 验证
        $this->validate(request(), [
            'content' => 'required|min:3'
        ]);

        /**
         * 逻辑
         * 
         * 这里通过模型关联访问comments表，并保存评论数据；
         * 
         * 为什么要新建Comment模型对象？
         *   之前的用例中，同时保存多个表单数据，需要在模型中设置$fillable属性，使得能够同时保存多个数据；
         *   如果不设置$fillable，就不能同时传递多个字段的值，而是通过传递一个数据对象；
         */
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->post_id = request('post_id');
        $comment->content = request('content');
        $post->comments()->save($comment);

        // 渲染
        return back();
    }

    // 点赞
    public function up(Post $post) {
        /**
         * 对文章的点赞行为
         *   包含两个参数：①点赞行为发起方的user_id；②被赞的文章的id
         */
        $param = [
            'user_id' => Auth::id(),
            'post_id' => $post->id,
        ];
        Up::firstOrCreate($param);
        return back();
    }

    // 取消点赞
    public function unup(Post $post) {
        $post->up(Auth::id())->delete();
        return back();
    }

    // 搜索功能模块
    public function search() {
        // 验证
        $this->validate(request(), [
            'query' => 'required'
        ]);

        // 逻辑
        $query = request('query');
        $posts = Post::search($query)->paginate(3);

        // 渲染
        return view('frontend.post.search', compact('query', 'posts'));
    }

}
