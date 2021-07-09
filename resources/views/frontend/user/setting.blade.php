@extends('frontend.layout.main')

@section('style')
<!-- Bootstrap core CSS -->
<link rel="stylesheet" src="http://localhost/styles/bootstrap-3.3.7/bootstrap.min.css">
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

  <form class="form-horizontal" action="/user/setting/{{ $user->id }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
      <label class="col-sm-2 control-label">用户名</label>
      <div class="col-sm-10">
        <input class="form-control" name="name" type="text" value="">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">头像</label>
      <div class="col-sm-2">
        <input class=" file-loading preview_input" type="file" value="用户名" style="width:72px" name="avatar">
        <img  class="preview_img" src="image/user.jpeg" alt="" class="img-rounded" style="border-radius:500px;">
      </div>
    </div>

    <button type="submit" class="btn btn-default">修改</button>

  </form>
  <br>

</div>
@endsection

@section('javascript')
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="http://localhost/scripts/jquery-3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/scripts/bootstrap-3.3.7/bootstrap.min.js"></script>
<script type="text/javascript" src="/scripts/my/search.js"></script>
<script type="text/javascript" src="/scripts/my/focus.js"></script>
@endsection