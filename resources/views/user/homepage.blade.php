@extends('layout.user')
@section('content')

<div class="col-sm-8">
  {{-- 用户概况 --}}
  <blockquote>
    <p><img src="{{ $homepageUser->avatar }}" alt="" class="img-rounded" style="border-radius:500px; height: 40px">{{ $homepageUser->name }}</p>
    <footer>关注：{{ $homepageUser->stars_count }}｜粉丝：{{ $homepageUser->fans_count }}｜文章：{{ $homepageUser->posts_count }}</footer>
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
          <p class=""><a href="/user/{{ $post->user->id }}">{{ $post->user->name }}</a> {{ $post->created_at->difForHumans() }}</p>
          <p class=""><a href="/posts/{{ $post->id }}" >{{ $post->title }}</a></p>
          <p>{!! str_limit($post->content, 100, ……) !!}</p>
        </div>
        @endforeach
      </div>

      {{-- 该用户关注的用户的列表 --}}
      <div class="tab-pane" id="tab_2">
        @foreach($starUsers as $star)
        <div class="blog-post" style="margin-top: 30px">
          <p class="">{{ $star->name }}</p>
          <p class="">关注：{{ $star->stars_count }} | 粉丝：{{ $star->fans_count }}｜ 文章：{{ $star->posts_count }}</p>

          <div>
            <button class="btn btn-default like-button" like-value="1" like-user="6" _token="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy" type="button">取消关注</button>
          </div>

        </div>
        @endforeach
      </div>

      {{-- 该用户的粉丝列表 --}}
      <div class="tab-pane" id="tab_3">
        @foreach($fanUsers as $fan)
        <div class="blog-post" style="margin-top: 30px">
          <p class="">{{ $fan->name }}</p>
          <p class="">关注：{{ $fan->stars_count }} | 粉丝：{{ $fan->fans_count }}｜ 文章：{{ $fan->posts_count }}</p>
        </div>
        @endforeach
      </div>

    </div>

  </div>
</div>
@endsection