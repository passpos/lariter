@extends('frontend.layout.main')
@section('style')
<!-- Bootstrap core CSS -->
<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<!--<link src="http://localhost/styles/bootstrap-4.1.3/bootstrap.min.css" rel="stylesheet">-->
<!-- Custom styles for this template -->
<link rel="stylesheet" href="/styles/blog.css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
@endsection

@section('content')
<div class="blog-post">
  <div style="display:inline-flex">

    {{-- 1. 标题 --}}
    <h2 class="blog-post-title">{{ $title }}</h2>
    @can('update',$post)
    {{--实时编辑按钮--}}
    <a style="margin: auto"  href="/posts/edit/{{ $postid }}">
      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
    </a>
    @endcan
    @can('delete',$post)
    {{--实时删除按钮--}}
    <a style="margin: auto"  href="/posts/delete/{{ $postid }}">
      <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
    </a>
    @endcan

  </div>

  {{-- 2. 创作日期与作者--}}
  <p class="blog-post-meta"><a href="#">{{ $author }}</a>{{ $post->created_at->toFormattedDateString() }}</p>

  <!-- 3. 文章-->
  <p>{!! $post->content !!}</p>

  <div>
    @if($post->up(Auth::id())->exists())
    <a href="/posts/unup/{{ $postid }}" type="button" class="btn btn-default btn-lg">取消赞</a>
    @else
    <a href="/posts/up/{{ $postid }}" type="button" class="btn btn-primary btn-lg">赞</a>
    @endif
  </div>
</div>

<div class="panel panel-default">
  {{-- Default panel contents --}}
  <div class="panel-heading">评论</div>

  {{-- List group --}}
  <ul class="list-group">
    @foreach($post->comments as $comment)
    <li class="list-group-item">
      <h5>{{ $comment->created_at }} 由 {{ $comment->user->name }} 发表</h5>
      <div>
        {{ $comment->content }}
      </div>
    </li>
    @endforeach
  </ul>

</div>

<div class="panel panel-default">
  {{-- Default panel contents --}}
  <div class="panel-heading">发表评论</div>

  {{-- List group --}}
  <ul class="list-group">
    <form action="/posts/comment/{{ $postid }}" method="POST">
      @csrf
      <input type="hidden" name="post_id" value="{{ $postid }}"/>
      <li class="list-group-item">
        <textarea name="content" class="form-control" rows="10"></textarea>
        @include("frontend.layout.errors")
        <button class="btn btn-default" type="submit">提交</button>
      </li>
    </form>

  </ul>
</div>
@endsection

@section('javascript')
<!-- Placed at the end of the document so the pages load faster -->
<!--
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
-->
<script type="text/javascript" src="http://localhost/scripts/jquery-3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/scripts/bootstrap-3.3.7/bootstrap.min.js"></script>
<script type="text/javascript" src="/scripts/my/search.js"></script>
@endsection