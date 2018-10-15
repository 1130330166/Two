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
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">商品名称</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">价格</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">商品分类</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">图片</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">商品库存</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">最后操作时间</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">状态</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($data as $v)
      <tr class="odd">
        <td class="sorting_1">{{$v->id}}</td>
        <td class="sorting_1">{{$v->name}}</td>
        <td class="sorting_1">{{$v->price}}</td>
        <td class="sorting_1">{{$v->catename}}</td>
        <td class="sorting_1"><img src="{{$v->pic}}" width="100"></td>
        <td class="sorting_1">{{$v->num}}</td>
        <td class="sorting_1">{{$v->time}}</td>
        <!-- <td class="sorting_1">{{$v->status=='0'?'下架':'上架'}}</td> -->
        <!-- 这里用ajax作按钮操作状态 -->
         @if($v->status)
        <td class="  sorting_1"><center><a href="javascript:void(0)" class="btn btn-info jia">上架</a></center></td>
        @else
        <td class="  sorting_1"><center><a href="javascript:void(0)" class="btn btn-danger jia">下架</a></center></td>
        @endif
        <td class="  sorting_1">
          <center>
          <form action="/goods/{{$v->id}}" method="post">
            <button class="btn btn-success">删除</button>
            {{method_field("DELETE")}}
            {{csrf_field()}}
          </form>
          <a href="/goods/{{$v->id}}/edit" class="btn btn-info edit">修改</a>
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
    $('.jia').click(function(){
      // alert(1);
      jia=$(this).html();
      id=$(this).parents().find('td:first').html();
      a=$(this);
      // alert(id);
      if(jia=='下架'){
        jia='1';
      }else{
        jia='0';
      }
      // alert(jia);
      $.get('/goodsstatus',{status:jia,id:id},function(data){
        if(data){
          if(jia == 1){
            a.html('上架').attr('class','btn btn-info jia');
          }else if(jia == 0){
            a.html('下架').attr('class','btn btn-danger jia');
          }
        }
    });
    });
 </script>
</html>
@endsection
@section('title','商品列表')