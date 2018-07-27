@extends('layout.main')
@section('content')
<div class="col-sm-8 blog-main">
  <form action="/posts" method="POST">
    <!--CSRF保护-->
    @csrf
    
    <!--在下面输入标题-->
    <div class="form-group">
      <label>标题</label>
      <input name="title" type="text" class="form-control" placeholder="这里是标题">
    </div>
    
    <!--在下面输入内容文本-->
    <div class="form-group">
      <label>内容</label>
      <div id="editormenu" style="width:620px"></div>
      <div id="content"  style="height:400px;max-height:500px;" name="content" class="form-control" placeholder="这里是内容"></div>
    </div>

    <!--在下面显示错误提示信息-->
    @if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </div>
    @endif

    <button type="submit" class="btn btn-default">提交</button>

  </form>
  <br>
</div><!-- /.blog-main -->
@endsection