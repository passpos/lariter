@extends('frontend.layout.editor')
@section('content')
<form action="/posts/store/{{$post->id}}" method="POST" style="width:800px">
  {{method_field("PUT")}}
  @csrf

  <div class="form-group">
    <label>标题</label>
    <input name="title" type="text" class="form-control" placeholder="这里是标题" value="{{ $post->title }}">
  </div>

  <div class="form-group">
    <label>内容</label>
    <textarea id="editor_1" name="content" class="form-control" style="height:600px;max-height:1000px;" placeholder="这里是内容">
        {{ $post->content }}
    </textarea>
  </div>

  @include('frontend.layout.errors')

  <button type="submit" class="btn btn-default">提交</button>
</form>
<br>

@endsection

