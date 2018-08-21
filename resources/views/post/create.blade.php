@extends('layout.passageer')
@section('content')
<form action="/posts" method="POST">
  @csrf
  <div class="form-group" style="width:800px">
    <label>标题</label>
    <input name="title" type="text" class="form-control" placeholder="这里是标题">
  </div>

  <div class="form-group">
    <label>内容</label>
    <textarea id="editor_1" name="content" style="border: solid 1px #666; width:800px; height:500px;">
        <strong>在这里添加内容</strong>
    </textarea>
  </div>

  @include('layout.error')

  <!--提交按钮-->
  <button  id="passage-store" type="submit" class="btn btn-default">提交</button>

</form>

<br>
@endsection