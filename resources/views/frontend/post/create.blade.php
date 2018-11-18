@extends('frontend.layout.editor')
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

<br>
@endsection