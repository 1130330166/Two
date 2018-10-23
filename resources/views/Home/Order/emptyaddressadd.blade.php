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
      <h3 class="margin-bottom-1x padding-top-1x">新增收货地址</h3>
      <form action="/homeorder" class="row" method="post">

        <!-- <div class="col-sm-3">
            <div class="form-group">
                <label>所在地区</label>
                <select class="form-control" name="path">
                 <option>请选择</option>
                </select> 
            </div>
        </div> -->

        <div class="col-sm-6">
            <div class="form-group">
                <label>收件人</label>　<span id="aname"></span>
                <input class="form-control" type="text" name="aname">
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label>邮编</label>　<span id="postalcode"></span>
                <input class="form-control" type="text" name="postalcode" maxlength="6" />
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label>联系电话</label>　<span id="phone"></span>
                <input class="form-control" type="text" name="phone" />
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label>详细地址</label>　<span id="address"></span>
                <input class="form-control" type="text" name="address" />
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label>备注</label>　<span id="beizhu"></span>
                <input class="form-control" type="text" name="beizhu" value="" />
            </div>
        </div>

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

    //页面加载完成自动调用
    $(function(){

      //收件人输入框获取焦点事件
      $('input[name=aname]').focus(function(){

        //清空span的提示信息
        $('#aname').html("");
      });
      //收件人输入框失去焦点事件
      $('input[name=aname]').blur(function(){

        //判断收件人是否为空
        if($('input[name=aname]').val() == ''){

          $('#aname').html("<font style='color:#f00'>收件人不能为空!</font>");
        }
      });

      //邮编输入框获取焦点事件
      $('input[name=postalcode]').focus(function(){

        //清空span的提示信息
        $('#postalcode').html("");
      });
      //收件人输入框失去焦点事件
      $('input[name=postalcode]').blur(function(){

        //判断收件人是否为空
        if($('input[name=postalcode]').val() == ''){

          $('#postalcode').html("<font style='color:#f00'>邮编不能为空,如不清楚请填000000!</font>");
        }
      });

      //联系电话输入框获取焦点事件
      $('input[name=phone]').focus(function(){

        //清空span的提示信息
        $('#phone').html("");
      });
      //联系电话输入框失去焦点事件
      $('input[name=phone]').blur(function(){

        //判断联系电话是否为空
        if($('input[name=phone]').val() == ''){

          $('#phone').html("<font style='color:#f00'>联系电话不能为空!</font>");
        }
      });

      //收货地址输入框获取焦点事件
      $('input[name=address]').focus(function(){

        //清空span的提示信息
        $('#address').html("");
      });
      //收货地址输入框失去焦点事件
      $('input[name=address]').blur(function(){

        //判断收货地址是否为空
        if($('input[name=address]').val() == ''){

          $('#address').html("<font style='color:#f00'>收货地址不能为空!</font>");
        }
      });

    });

    //
    $(':submit[title=add]').click(function(){

      //判断收件人是否为空
      if($('input[name=aname]').val() == ''){

        $('#aname').html("<font style='color:#f00'>收件人不能为空!</font>");
        return false;
      }

      //判断收件人是否为空
      if($('input[name=postalcode]').val() == ''){

        $('#postalcode').html("<font style='color:#f00'>邮编不能为空,如不清楚请填000000!</font>");
        return false;
      }

      //判断联系电话是否为空
      if($('input[name=phone]').val() == ''){

        $('#phone').html("<font style='color:#f00'>联系电话不能为空!</font>");
        return false;
      }

      //判断收货地址是否为空
      if($('input[name=address]').val() == ''){

        $('#address').html("<font style='color:#f00'>收货地址不能为空!</font>");
        return false;
      }

    });
    
  </script>
@endsection