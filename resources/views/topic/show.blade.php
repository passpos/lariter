@extends("layout.index")
@section("content")
{{-- 专题详情头部 --}}
<div class="col-sm-8">
  <blockquote>
    <p>{{ $istopic->name }}</p>
    <footer>文章：{{ $istopic->topic_posts_count }}</footer>
    <button 
        class="btn btn-default topic-submit"  
        data-toggle="modal" 
        data-target="#topic_submit_modal" 
        topic-id="{{ $istopic->id }}" 
        type="button">
      投稿
    </button>
  </blockquote>
</div>

{{-- 待投稿文章（默认隐藏，点击投稿按钮显示） --}}
<div class="modal fade" id="topic_submit_modal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">我的文章</h4>
      </div>
      <div class="modal-body">
        <form action="/topic/publish/{{ $istopic->id }}" method="POST">
          @csrf
          @foreach($myposts as $post)
          <div class="checkbox">
            <label>
              <input type="checkbox" name="post_ids[]" value="{{ $post->id }}">
              {{ $post->title }}
            </label>
          </div>
          @endforeach
          <button type="submit" class="btn btn-default">投稿</button>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- 专题内的文章的列表 --}}
<div class="col-sm-8 blog-main">
  <div class="nav-tabs-custom">
    <div class="tab-content">
      <div class="tab-pane active" id="tab_1">
        @foreach($posts as $post)
        <div class="blog-post" style="margin-top: 30px">
          <p class=""><a href="/user/{{ $post->user->id }}">{{ $post->user->name }}</a>{{ $post->created_at->toFormattedDateString() }}</p>
          <p class=""><a href="/posts/{{ $post->id }}" >{{ $post->title }}</a></p>
          <p>{!! str_limit($post->content, 0, '……') !!}</p>
        </div>
        @endforeach
      </div>

    </div>
    <!-- /.tab-content -->
  </div>


</div><!-- /.blog-main -->
@endsection