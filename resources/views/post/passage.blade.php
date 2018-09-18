@extends('layout.passageer')
@section('content')
<div class="blog-post">
  <div style="display:inline-flex">

    {{-- 1. 标题 --}}
    <h2 class="blog-post-title">{{$post->title}}</h2>
    @can('update',$post)
    {{--实时编辑按钮--}}
    <a style="margin: auto"  href="/posts/{{$post->id}}/edit">
      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
    </a>
    @endcan
    @can('delete',$post)
    {{--实时删除按钮--}}
    <a style="margin: auto"  href="/posts/{{$post->id}}/delete">
      <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
    </a>
    @endcan

  </div>

  {{-- 2. 创作日期与作者--}}
  <p class="blog-post-meta"><a href="#">{{ $post->user->name }}</a>{{ $post->created_at->toFormattedDateString() }}</p>

  <!-- 3. 文章-->
  <p>{!! $post->content !!}</p>

  <div>
    @if($post->up(Auth::id())->exists())
    <a href="/posts/unup/{{ $post->id }}" type="button" class="btn btn-default btn-lg">取消赞</a>
    @else
    <a href="/posts/up/{{ $post->id }}" type="button" class="btn btn-primary btn-lg">赞</a>
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
    <form action="/posts/comment/{{$post->id}}" method="POST">
      @csrf
      <input type="hidden" name="post_id" value="{{$post->id}}"/>
      <li class="list-group-item">
        <textarea name="content" class="form-control" rows="10"></textarea>
        @include("layout.errors")
        <button class="btn btn-default" type="submit">提交</button>
      </li>
    </form>

  </ul>
</div>

@endsection