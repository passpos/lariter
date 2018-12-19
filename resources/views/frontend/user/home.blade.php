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
<div class="col-sm-8 blog-main">
  <p>个人空间</p>
</div>
@endsection

@section('javascript')
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="/js/jquery-3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="/js/bootstrap-3.3.7/bootstrap.min.js"></script>
<script src="/js/my/frontend.js"></script>
<script type="text/javascript" src="/js/my/userAction.js"></script>
@endsection