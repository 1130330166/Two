@extends('Home.HomePublic.public')
@section('title','结算')
@section('home')
<div style="background-color: #36414F; height: 124px;"></div>
      
  <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>

  <!-- 添加成功与否信息显示开始 -->
  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show text-center margin-bottom-1x">
      <span class="alert-close" data-dismiss="alert"></span>
      <p>{{session('success')}}</p>
  </div>
  @endif

  @if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x">
      <span class="alert-close" data-dismiss="alert"></span>
      <p>{{session('error')}}</p>
  </div>
  @endif
  <!-- 添加成功与否信息显示结束 -->

    <div class="col-md-12">
          
          <div class="col-sm-12">
          <!-- 购物车商品展示开始 -->
          <table class="table">
          <thead>
          <tr>
              <th class="text-center" style="font-size: 22px;">商品名称</th>
              <th class="text-center" style="font-size: 22px;">数量</th>
              <th class="text-center" style="font-size: 22px;">单价</th>
              <th class="text-center" style="font-size: 22px;">小计</th>
          </tr>
          </thead>
              @if(!empty($goods))
              @foreach($goods as $row)
              <tr class="trs">
                  <td width="400">
                      <div class="text-center">
                          <img src="{{$row->pic}}" alt="Product" width="100">
                          <span style="font-size: 22px;"><a href="/home/{{$row->id}}" class="btn btn-link-info">{{$row->name}}</a></span>
                      </div>
                  </td>
                  <td class="text-center">
                      <div class="gw_num">
                          *{{$row->num}}
                      </div>
                  </td>
                  <td class="text-center text-lg text-medium price">{{$row->price}}</td>
                  <td class="text-center">
                      {{$row->num*$row->price}}
                  </td>
              </tr>
              @endforeach
              @endif
          </table>
            <div class="text-right"><span class="text-medium" style="font-size: 22px;">应付:¥{{$total}}</span></div>
          <!-- 购物车商品展示结束 -->
          </div>
      <div class="padding-top-3x hidden-md-up"></div>
      
      <!-- 地址管理标题开始 -->
      <div>
        <div class="col-12 text-center text-sm-left" style="display: inline;">
          <span style="font-size: 22px;"">管理收货地址</span>
        </div>

        <div class="col-12 text-center text-sm-right" style="display: inline;">
          <span style="font-size: 22px;color: dodgerblue;"><a href="/homeaddress" style="text-decoration: none;">添加收货地址</a></span>
        </div>
      </div>
      <!-- 地址管理标题结束 -->
       
    <form action="javascript:void(0)" method="get" id="form1" onsubmit="return check();">
      <!-- 遍历收货地址开始 --> 
      <div class="table-responsive shopping-cart"> 
       <table class="table"> 
        <thead> 
         <tr>

          <th class="text-center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">选择</font></font></th>

          <th class="text-center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">收件人</font></font></th>

          <!-- <th class="text-center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">所在地区</font></font></th> -->

          <th class="text-center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">详细地址</font></font></th>

          <th class="text-center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">邮政编码</font></font></th>

          <th class="text-center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">联系电话</font></font></th>

          <th class="text-center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">操作</font></font></a> </th> 
          <th class="text-center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">设为默认</font></font></a> </th> 

         </tr> 
        </thead> 

        <tbody> 

         @if(!empty($address))
         @foreach($address as $row)
         <tr> 
          <!-- 判断用户选择哪个地址开始 -->
          @if($row->isdefault == 1)
          <td class="text-center text-lg text-medium"><input type="radio" name="seladdress" value="{{$row->id}}" checked></td>
          @elseif($row->isdefault == 0)
          <td class="text-center text-lg text-medium"><input type="radio" name="seladdress" value="{{$row->id}}"></td>
          @endif
          <!-- 判断用户选择哪个地址结束 -->

          <td class="text-center text-lg text-medium">{{$row->aname}}</td>
          <!-- <td class="text-center text-lg text-medium">{{$row->path}}</td>  -->
          <td class="text-center text-lg text-medium">{{$row->address}}</td>
          <td class="text-center text-lg text-medium">{{$row->postalcode}}</td>
          <td class="text-center text-lg text-medium">{{$row->phone}}</td> 
          <td class="text-center text-lg text-medium">
            
            <form action="/homeaddress/{{$row->id}}/edit" method="get">
              <button type="submit" class="btn btn-link-danger" title="编辑"><i class="icon-tag"></i></button>
              {{csrf_field()}}
            </form> 
            
            <form action="/homeaddress/{{$row->id}}" method="post">
              <button type="submit" class="btn btn-link-danger" title="移除" onclick="return confirm('确定删除该地址吗?');"><i class="icon-cross"></i></button>
              {{method_field("DELETE")}}
              {{csrf_field()}}
            </form> 
          </td> 
          @if($row->isdefault == 1)
          <td class="text-center text-lg text-medium">
            <a href="/homeaddresssetdefault/{{$row->id}}" title="设为默认" class="btn btn-sm btn-info">设为默认</a>
          </td>
          @else
          <td class="text-center text-lg text-medium">
            <a href="/homeaddresssetdefault/{{$row->id}}" title="设为默认" class="btn btn-sm btn-link-primary">设为默认</a>
          </td>
          @endif
         </tr> 
         @endforeach
         @endif
        </tbody> 
       </table> 
        
      </div> 
      <!-- 遍历收货地址结束 -->

      <!-- 订单备注开始 -->
      <div class="col-sm-8">
          <div class="form-group">
              <label><span style="font-size: 22px;">备注</span></label>　<span id="beizhu"></span>
              <input class="form-control" type="text" name="beizhu" />
          </div>
      </div>
      <!-- 订单备注结束 -->

      <div class="col-12 text-center text-sm-right">
          <button class="btn btn-outline-success margin-bottom-none" title="add" type="submit">提交订单</button>
      </div>
      {{csrf_field()}}
    </form>
      
    </div>
    <br>
    
   </div> 
  </div> 
  <!-- End Contacts & Shipping Address -->
  <script type="text/javascript">

    //表单加载完成自动执行
    $(function(){

      //获取用户选中的地址ID值
      var address = $('input[type=radio]:checked').val();
      // alert(address);
      //判断是否有选中地址,如果用户没有设置默认地址,是不会自动选中的
      if(address == undefined){

       //将用户地址表中的第一个地址选中
       address = $('input[type=radio]:first').attr('checked','checked').val();
        // alert(address);
      }
      //表单form1地址设定[路由/选中地址id]
      $('#form1').attr('action',"/makeorderwithaddress/"+address);

      //选中地址发生改变函数
      $('input[type=radio]').change(function(){
        //用户另选地址
        //获取用户选中的地址ID值
        address = $('input[type=radio]:checked').val();
        // alert(address);
        //表单form1地址设定[路由/选中地址id]
        $('#form1').attr('action',"/makeorderwithaddress/"+address);
      });
    });
    
    //检查用户是否选中地址
    function check(){

        //判断
        if(address == undefined){
          alert('请选择收货地址!');
          return false;
        }
    }
    
  </script>
@endsection