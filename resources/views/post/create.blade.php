@extends('layout.passageEditor')
@section('content')
<div class="col-sm-8 blog-main">
  <form action="/posts" method="POST">
    @csrf
    <div class="form-group">
      <label>标题</label>
      <input name="title" type="text" class="form-control" placeholder="这里是标题">
    </div>

    <div class="form-group">
      <label>内容</label>
      <textarea id="editor_1" name="content" style="border: solid 1px #666; width:700px; height:300px;">
        <strong>在这里添加内容</strong>
      </textarea>
    </div>

    <!--错误提示信息-->
    @if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
      @foreach($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </div>
    @endif

    <!--提交按钮-->
    <button  id="passage-store" type="submit" class="btn btn-default">提交</button>

  </form>




  <br>
</div><!-- /.blog-main -->
@endsection