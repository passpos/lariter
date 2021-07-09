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
<div class="col-sm-8 blog-main">
  <div>
    <div id="carousel-example" class="carousel slide" data-ride="carousel">

      {{-- Indicators --}}
      <ol class="carousel-indicators">
        <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example" data-slide-to="1"></li>
        <li data-target="#carousel-example" data-slide-to="2"></li>
      </ol>

      {{-- Wrapper for slides --}}
      <div class="carousel-inner">

        <div class="item active">
          <img src="http://ww1.sinaimg.cn/large/44287191gw1excbq6tb3rj21400migrz.jpg" alt="..." />
          <div class="carousel-caption">...</div>
        </div>

        <div class="item">
          <img src="http://ww3.sinaimg.cn/large/44287191gw1excbq5iwm6j21400min3o.jpg" alt="..." />
          <div class="carousel-caption">...</div>
        </div>

        <div class="item">
          <img src="http://ww2.sinaimg.cn/large/44287191gw1excbq4kx57j21400migs4.jpg" alt="..." />
          <div class="carousel-caption">...</div>
        </div>
      </div>

      {{-- Controls --}}
      <a class="left carousel-control" href="#carousel-example" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left">
        </span>
      </a>
      <a class="right carousel-control" href="#carousel-example" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right">
        </span>
      </a>

    </div>
  </div>

  <div style="height: 20px;"></div>

  <div>
    @foreach($posts as $post)
    <div class="blog-post">
      <h2 class="blog-post-title">
        <a href="/posts/{{ $post->id }}" >{{ $post->title }}</a>
      </h2>

      <p class="blog-post-meta">
        <a href="/user/detail/{{ $post->user->id }}">{{ $post->user->name }}</a>
        {{ $post->created_at->toFormattedDateString() }}
      </p>
      {{ Str::limit($post->content, 100, '……') }}
      @include('frontend.post.components.postcount')
    </div>
    @endforeach

    {{-- 分页链接 --}}
    {{ $posts->links() }}

  </div>{{-- /.blog-main --}}
</div>
@endsection

@section('sidebar')
@include('frontend.layout.sidebar')
@endsection

@section('javascript')
<!-- 
      Bootstrap core JavaScript 
      Placed at the end of the document so the pages load faster
-->
<script type="text/javascript" src="http://localhost/scripts/jquery-3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/scripts/bootstrap-3.3.7/bootstrap.min.js"></script>
<script type="text/javascript" src="/scripts/my/search.js"></script>
@endsection
