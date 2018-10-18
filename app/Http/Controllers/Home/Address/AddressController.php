<?php

namespace App\Http\Controllers\Home\Address;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引入DB类
use DB;
class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //查询用户所有收货地址
    public function index()
    {
        //根据Pid查询所有分类数据传递到公共模板导航栏
        $cates = self::getCatesByPid(0);

        //查询该用户所有的收货地址 降序排列[默认地址在首位]isdefault 1为默认
        $data = DB::table("mall_address")->where('uid','=',session('uid'))->orderBy("isdefault","desc")->get();
        //判断邮编是否为空 如果是则赋值为000000
        foreach($data as $k => $v){
            //如果邮编为空则设置为000000 否则取出邮编
            $data[$k]->postalcode = $v->postalcode==''?'000000':$v->postalcode;
        }
        
        // var_dump($data);
        //加载模板传递数据
        return view("Home.Address.address",['data'=>$data,'cates'=>$cates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //用户添加收货地址
    public function store(Request $request)
    {
        //获取传递过来的数据
        $data = $request->except('_token');
        //从session中获取登录的用户ID,整合到数组中
        $data['uid'] = session('uid');
        // var_dump($data);exit;
        //将数据插入数据库
        if(DB::table('mall_address')->insert($data)){

            return redirect("/homeaddress")->with("success","添加成功!");
        }else{

            return redirect("/homeaddress")->with("success","添加失败!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //根据Pid查询所有分类数据传递到公共模板导航栏
        $cates = self::getCatesByPid(0);
        //查询该用户所有地址降序排序
        $data = DB::table('mall_address')->where('uid','=',session('uid'))->orderBy('isdefault','desc')->get();
        //判断邮编是否为空 如果是则赋值为000000
        foreach($data as $k => $v){
            //如果邮编为空则设置为000000 否则取出邮编
            $data[$k]->postalcode = $v->postalcode==''?'000000':$v->postalcode;
        }

        //根据ID查询要被更新的地址
        $info = DB::table('mall_address')->where('id','=',$id)->first();
        //判断邮编是否为空 如果是则赋值为000000
        $info->postalcode = $info->postalcode==''?'000000':$info->postalcode;
        // var_dump($info);exit;
        // 加载更新地址模板,分配数据
        return view("Home.Address.edit",['cates'=>$cates,'data'=>$data,'info'=>$info]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //获取修改的值
        $data = $request->except('_token','_method');
        //根据ID更新地址
        if(DB::table('mall_address')->where('id','=',$id)->update($data)){

            return redirect('/homeaddress')->with("success","地址更新成功!");
        }else{

            return redirect('/homeaddress')->with('error','地址更新失败!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //根据ID删除指定地址,判断是否成功
        if(DB::table("mall_address")->where('id','=',$id)->delete()){

            return redirect('/homeaddress')->with("success","删除成功!");
        }else{

            return redirect('/homeaddress')->with("error","删除失败!");
        }
    }

    //前台用户设置默认地址
    public function setDefault($id){

        //判断是否有要设置默认地址的ID传递过来
        if(!empty($id)){

            //ID不为空,用户要设置新的默认地址,先将原来的默认地址设为0,isdefault 0不是默认地址 1是默认地址
            //判断该用户地址表下是否有设置默认地址isdefault=>1
            if(DB::table("mall_address")->where('isdefault','=',1)->count() > 0){

                //该用户地址表下存在默认地址,先删除默认地址[将原来的默认地址更新为普通地址isdefault=0],后更新
                if(DB::table("mall_address")->where('isdefault','=',1)->update(['isdefault'=>0])){

                    //重置默认地址成功,更新用户想设置的默认地址
                    if(DB::table("mall_address")->where('id','=',$id)->update(['isdefault'=>1])){

                        return redirect('/homeaddress')->with("success","默认地址更新成功!");
                    }else{

                        return redirect('/homeaddress')->with("error","默认地址更新失败,请联系客服!");
                    }
                }else{
                    //将原来的默认地址重置为普通地址失败!
                    return redirect('/homeaddress')->with("error","默认地址更新失败,请联系客服!");
                }
            }else{

                //该用户地址表下没有默认地址,直接更新用户想设置的默认地址
                if(DB::table("mall_address")->where('id','=',$id)->update(['isdefault'=>1])){

                    return redirect('/homeaddress')->with("success","默认地址设置成功!");
                }else{

                    return redirect('/homeaddress')->with("error","默认地址设置失败,请联系客服!");
                }
            }
            
        }
    }

    //无限分类递归数据遍历
    public static function getCatesByPid($pid){

        $res = DB::table("mall_cates")->where("pid",'=',$pid)->get();
        $data = [];
        //遍历
        foreach($res as $key => $value){
            //获取父类的子类信息
            $value->dev = self::getCatesByPid($value->id);
            $data[] = $value;
        }
        return $data;
    }
}
