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
<form action="/posts/store" method="POST" style="width:800px">
  @csrf

  <div class="form-group">
    <label>标题</label>
    <input name="title" type="text" class="form-control" placeholder="这里是标题">
  </div>

  <div class="form-group">
    <label>内容</label>
    <textarea id="editor_1" name="content" style="border: solid 1px #666; width:800px; height:600px;">
        在这里添加内容
    </textarea>
  </div>

  @include('frontend.layout.errors')

  {{-- 提交按钮 --}}
  <button  id="passage-store" type="submit" class="btn btn-default">保存</button>

</form>
<br/>
@endsection

@section('javascript')
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="/js/jquery-3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="/js/bootstrap-3.3.7/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/NKeditor5.0.3.2/NKeditor-all-min.js"></script>
<script type="text/javascript" src="/js/NKeditor5.0.3.2/lang/zh-CN.js"></script>
<script src="/js/my/frontend.js"></script>
<script type="text/javascript" src="/js/my/editor.js"></script>
@endsection