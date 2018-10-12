@extends("Admin.AdminPublics.public")
@section('admin')
<html>
 <head></head>
 <script type="text/javascript" src="static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i>@yield('title')</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">轮播图名</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">轮播图图片</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">状态</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">创建时间</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
      <tr class="odd">
        @foreach($arr as $v)
        <td class="  sorting_1">{{$v->id}}</td>
        <td class="  sorting_1">{{$v->name}}</td>
        <td class="  sorting_1"><img src="{{$v->path}}" width="100"></td>
        @if($v->status)
        <td class="  sorting_1"><center><a href="javascript:void(0)" class="btn btn-info contrary">开启</a></center></td>
        @else
        <td class="  sorting_1"><center><a href="javascript:void(0)" class="btn btn-danger contrary">禁用</a></center></td>
        @endif
        <td class="  sorting_1">{{$v->time}}</td>
        <td class="  sorting_1">
          <center>
          <form action="/lunbo/{{$v->id}}" method="post">
            <button class="btn btn-success">删除</button>
            {{method_field("DELETE")}}
            {{csrf_field()}}
          </form>
          <a href="/lunbo/{{$v->id}}/edit" class="btn btn-info edit">修改</a>
          </center>
        </td>
       </tr>
       @endforeach
      </tbody>
     </table>
     <div class="dataTables_paginate paging_full_numbers" id="pages">
     </div>
    </div> 
   </div> 
  </div>
 </body>
 <script type="text/javascript">
  $('.contrary').click(function(){
    status = $(this).html();
    id = $(this).parents().find('td:first').html();
    a = $(this);
    if(status == '禁用'){
      status = 1;
    }else if(status == '开启'){
      status = 0;
    }
    $.get('/edit',{status:status,id:id},function(data){
        if(data){
          if(status == 1){
            a.html('开启').attr('class','btn btn-info contrary');
          }else if(status == 0){
            a.html('禁用').attr('class','btn btn-danger contrary');
          }
        }
    });
  });
 </script>
</html>
@endsection
@section('title','轮播图列表')