@extends('frontend.layout.main')

@section('style')
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="/css/bootstrap-3.3.7/bootstrap.min.css">
<!-- Custom styles for this template -->
<link rel="stylesheet" href="/css/blog.css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>

<![endif]-->
@endsection

@section('content')
<div class="col-sm-8">
  {{-- 用户概况 --}}
  <blockquote>
    <p><img src="{{ $detailUser->avatar }}" alt="" class="img-rounded" style="border-radius:500px; height: 40px">{{ $detailUser->name }}</p>
    <footer>关注：{{ $detailUser->stars_count }}｜粉丝：{{ $detailUser->fans_count }}｜文章：{{ $detailUser->posts_count }}</footer>
    @include('frontend.user.components.focus',['target_user' => $detailUser])
  </blockquote>
</div>

<div class="col-sm-8 blog-main">
  <div class="nav-tabs-custom">

    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
      <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
      <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
    </ul>

    <div class="tab-content">
      {{-- 该用户的文章列表 --}}
      <div class="tab-pane active" id="tab_1">
        @foreach($posts as $post)
        <div class="blog-post" style="margin-top: 30px">
          <p class=""><a href="/user/detail/{{ $post->user->id }}">{{ $post->user->name }}</a> {{ $post->created_at->diffForHumans() }}</p>
          <p class=""><a href="/posts/{{ $post->id }}" >{{ $post->title }}</a></p>
          <p>{!! str_limit($post->content, 0, '……') !!}</p>
        </div>
        @endforeach
      </div>

      {{-- 该用户关注的用户的列表 --}}
      <div class="tab-pane" id="tab_2">
        @foreach($starUsers as $star)
        <div class="blog-post" style="margin-top: 30px">
          <p class="">{{ $star->name }}</p>
          <p class="">关注：{{ $star->stars_count }} | 粉丝：{{ $star->fans_count }}｜ 文章：{{ $star->posts_count }}</p>
          @include('frontend.user.components.focus',['target_user' => $star])
        </div>
        @endforeach
      </div>

      {{-- 该用户的粉丝列表 --}}
      <div class="tab-pane" id="tab_3">
        @foreach($fanUsers as $fan)
        <div class="blog-post" style="margin-top: 30px">
          <p class="">{{ $fan->name }}</p>
          <p class="">关注：{{ $fan->stars_count }} | 粉丝：{{ $fan->fans_count }}｜ 文章：{{ $fan->posts_count }}</p>
          @include('frontend.user.components.focus',['target_user' => $fan])
        </div>
        @endforeach
      </div>
    </div>

  </div>

</div>
@endsection

@section('sidebar')
@include('frontend.layout.sidebar')
@endsection

@section('javascript')
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="/js/jquery-3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="/js/bootstrap-3.3.7/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/my/search.js"></script>
<script type="text/javascript" src="/js/my/focus.js"></script>
@endsection