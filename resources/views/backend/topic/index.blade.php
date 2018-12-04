@extends("backend.layout.main")
@section("content")
<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-10 col-xs-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">专题列表</h3>
        </div>
        <a type="button" class="btn " href="/backend/topics/create" >增加专题</a>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <th style="width: 10px">#</th>
                <th>专题名称</th>
                <th>操作</th>
              </tr>
              @foreach($topics as $topic)
              <tr>
                <td>{{ $topic->id }}</td>
                <td>{{ $topic->name }}</td>
                <td class="btn resource-delete" delete-url="/backend/topics/{{$topic->id}}">删除</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->
@endsection