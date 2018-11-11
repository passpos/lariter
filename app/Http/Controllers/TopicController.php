<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Post;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller {

    /**
     * 专题详情页
     * 
     * 需要返回给模板的数据：
     *   ①专题名称
     *   ②专题中的文章数
     *   ③专题中的文章的标题
     *   ④专题中的文章的部分内容
     *   ⑤我的未投稿的文章（标题）
     * 
     * topicCountPosts()、posts()是Topic模型中定义的方法；
     * authorBy()、topicNotBy()是Post模型中定义的scope方法；
     */
    public function show(Topic $topic,$topic_id) {
        // 专题文章数
        $istopic = Topic::withCount('topicPosts')->find($topic_id);
        // 专题文章列表
        $posts = $topic->posts()->orderBy('created_at', 'desc')->take(10)->get();
        dd($posts);
        // 我的未投稿的文章
        $myposts = Post::authorBy(Auth::id())->topicNotBy($topic_id)->get();
        return view('topic/show', compact('istopic', 'posts', 'myposts'));
    }

    public function publish(Topic $topic) {
        return view('topic/show');
    }

}
