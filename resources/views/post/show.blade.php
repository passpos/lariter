@extends('layout.passageer')
@section('content')
<div class="blog-post">
  <div style="display:inline-flex">

    <!-- 1. 标题 -->
    <h2 class="blog-post-title">{{$posts->title}}</h2>
    @can('update',$posts)
    <!--实时编辑按钮-->
    <a style="margin: auto"  href="/posts/{{$posts->id}}/edit">
      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
    </a>
    @endcan
    @can('delete',$posts)
    <!--实时删除按钮-->
    <a style="margin: auto"  href="/posts/{{$posts->id}}/delete">
      <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
    </a>
    @endcan

  </div>

  <!-- 2. 创作日期与作者-->
  <p class="blog-post-meta"><a href="#">{{$posts->user->name}}</a>{{$posts->created_at->toFormattedDateString()}}</p>

  <!-- 3. 文章-->
  <p>{!! $posts->content !!}</p>

  <div>
    <a href="/posts/{{$posts->id}}/zan" type="button" class="btn btn-primary btn-lg">赞</a>

  </div>
</div>

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">评论</div>

  <!-- List group -->
  <ul class="list-group">
    <li class="list-group-item">
      <h5>2017-05-28 10:15:08 by Kassandra Ankunding2</h5>
      <div>
        这是第一个评论这是第一个评论这是第一个评论这是第一个评论这是第一个评论这是第一个评论这是第一个评论这是第一个评论这是第一个评论
      </div>
    </li>
  </ul>
</div>

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">发表评论</div>

  <!-- List group -->
  <ul class="list-group">
    <form action="/posts/comment" method="post">
      <input type="hidden" name="_token" value="4BfTBDF90Mjp8hdoie6QGDPJF2J5AgmpsC9ddFHD">
      <input type="hidden" name="post_id" value="{{$posts->id}}"/>
      <li class="list-group-item">
        <textarea name="content" class="form-control" rows="10"></textarea>
        <button class="btn btn-default" type="submit">提交</button>
      </li>
    </form>

  </ul>
</div>

@endsection