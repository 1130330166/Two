@extends("Admin.AdminPublics.public")
@section('admin')
<html>
 <head></head>
 <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i>后台权限列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 157px;">编号</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 209px;">权限名</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 209px;">控制器</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 209px;">方法</th>


        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 101px;">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
      @foreach($nodelist as $row)
       <tr class="odd"> 
        <td class="  sorting_1">{{$i++}}</td> 
        <td class=" ">{{$row->name}}</td> 
        <td class=" ">{{$row->mname}}</td> 
        <td class=" ">{{$row->aname}}</td> 
        <td class=" ">
          <form action="/nodelist/{{$row->id}}" method="post">
            <button class="btn btn-success" onclick="return confirm('确定删除该权限吗?  ______危 险 操 作');">普通删除</button>
            {{method_field("DELETE")}}
            {{csrf_field()}}
          </form>
          <a href="/nodelist/{{$row->id}}/edit" class="btn btn-info"><i class="icon-wrench">修改</i></a></td> 
       </tr>
       @endforeach
      </tbody>
     </table>
      <!-- 分页开始 -->
         <div class="dataTables_paginate paging_full_numbers" id="pages">
         </div>
         <!-- 分页结束 -->
    </div> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section('title','后台权限列表')