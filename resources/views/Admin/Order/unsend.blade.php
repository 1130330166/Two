@extends("Admin.AdminPublics.public")
@section('title','后台订单管理')
@section('admin')

<html>
 <head></head>
 <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i>后台待发货订单列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
      <form action="/adminorderunsend" method="get">
     <div class="dataTables_filter" id="DataTables_Table_1_filter">
      <label><input type="text" aria-controls="DataTables_Table_1" name="keywords"  value="{{$request['keywords'] or ''}}"/></label>
      <!-- <input type="submit" value="搜索"> -->
      <button type="submit" class="btn btn-default">搜索</button>
     </div>
     </form>
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">

        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 10px;">ID</th>

        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 130px;">订单号</th>

         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 137px;">状态</th>

         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 137px;">下单时间</th>

         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 137px;">付款时间</th>

        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 101px;">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">

       @if(!empty($data))
       @foreach($data as $row)
       <tr class="odd"> 
        <td class="  sorting_1" align="center">{{$row->id}}</td> 
        <td class=" " align="center">{{$row->oid}}</td> 
        <td class=" " align="center">待发货</td> 
        <td class=" " align="center">{{$row->addtime}}</td> 
        <td class=" " align="center">{{$row->paytime}}</td> 

        <td class=" " align="center">
          <form action="/adminorder/{{$row->id}}" method="post">
            <button class="btn btn-inverse" onclick="return confirm('确定删除该订单吗?');"><i class="icon-remove"></i></button>
            {{method_field("DELETE")}}
            {{csrf_field()}}
          </form>

          <a href="/adminorder/{{$row->oid}}" class="btn btn-info"><i class="icon-list"></i></a>
        </td> 
       </tr>
       @endforeach
       @endif
      </tbody>
     </table>
     <div class="dataTables_paginate paging_full_numbers" id="pages">
        {{$data->appends($request)->render()}}
     </div>
    </div> 
   </div> 
  </div>
 </body>
 <script type="text/javascript">
 </script>
</html>
@endsection
