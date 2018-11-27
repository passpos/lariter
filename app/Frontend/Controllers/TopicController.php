<?php

namespace App\Frontend\Controllers;

use App\Mariadb\Frontend\Topic;
use App\Mariadb\Frontend\Post;
use App\Mariadb\Frontend\PostTopic;
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
    public function show($topic_id) {
        // 专题文章数
        $istopic = Topic::withCount('topicPosts')->find($topic_id);
        // 专题文章列表
        $posts = $istopic->posts()->orderBy('created_at', 'desc')->take(10)->get();
        // 我的未投稿的文章
        $myposts = Post::authorBy(Auth::id())->topicNotBy($topic_id)->get();
        return view('frontend.topic.show', compact('istopic', 'posts', 'myposts'));
    }

    /**
     * 向某专题投稿的表单接收
     */
    public function publish($topic_id) {
        $this->validate(request(), [
            'post_ids' => 'required|array',
        ]);
        $post_ids = request('post_ids');
//        dd($post_ids);
        foreach ($post_ids as $post_id) {
            PostTopic::firstOrCreate(compact('topic_id', 'post_id'));
        }
        return back();
    }

}
