@extends('frontend.layout.index')
@section('content')
<div class="alert alert-success" role="alert">
  搜索“{{ $query }}”，共找到{{ $posts->total() }}篇文章。
</div>

<div class="col-sm-8 blog-main">
  @foreach($posts as $post)
  <div class="blog-post">
    <h2 class="blog-post-title"><a href="/posts/{{ $post->id }}" >{{ $post->title }}</a></h2>
    <p class="blog-post-meta">{{ $post->created_at }} 由 <a href="/user/homepage/{{ $post->user->id }}">{{ $post->user->name }}</a> 写作</p>
    <p>{!! str_limit($post->content, 0, '……') !!}</p>
  </div>
  @endforeach
  {{ $posts->links() }}
</div><!-- /.blog-main -->
@endsection