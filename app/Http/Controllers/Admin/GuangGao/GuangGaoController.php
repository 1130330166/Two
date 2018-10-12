<?php

namespace App\Http\Controllers\Admin\GuangGao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//导入DB类
use DB;

class GuangGaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $arr = DB::table("mall_guanggao")->get();
        // dd($arr);
        return view('Admin.GuangGao.index',['arr'=>$arr]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.GuangGao.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // 屏蔽_token,file值
        $list = $request->except('_token','file');
        //判断是否有文件上传
        if($request->hasfile('file')){
            //初始化名字
            $name = time()+rand(10000,10000000);
            //获得文件后缀
            $arr = $request->file('file')->getClientOriginalExtension();
            // dd($arr);
            // dd(date(time()));
            // dd($list);
            //移动到指定的位置
            $request->file('file')->move('./uploads/'.date('Y-m-d',time()).'',$name.'.'.$arr);
            //设置状态
            $list['status'] = 0;
            //设置图片的地址
            $list['url'] = './uploads/'.date('Y-m-d',time()).'/'.$name.'.'.$arr;
            //设置创键时间
            $list['time'] = date("Y-m-d H:i:s",time());
            // dd($list);
            // 写入数据库
            if(DB::table('mall_guanggao')->insert($list)){
                //跳转到广告列表页
                return redirect('/guanggao')->with('success','添加成功');
            }else{
                return redirect('/guanggao/create')->with('error','添加失败');
            }
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
        $str = DB::table('mall_guanggao')->where('id','=',$id)->first();
        // dd($str);
        return view('Admin.GuangGao.edit',['str'=>$str]);
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
        // dd($request->all());
        // var_dump($request->all());
        $list = $request->except('_token','url','_method','file','id');
        $id = $request->input('id');
        if($request->hasfile('file')){
            //初始化名字
            $name = time()+rand(10000,10000000);
            //获得文件后缀
            $arr = $request->file('file')->getClientOriginalExtension();
            //移动到指定的位置
            $request->file('file')->move('./uploads/'.date('Y-m-d',time()).'',$name.'.'.$arr);
            //设置图片的地址
            $list['url'] = './uploads/'.date('Y-m-d',time()).'/'.$name.'.'.$arr;
            //设置创键时间
            $list['time'] = date("Y-m-d H:i:s",time());
            // dd($list);
            // 写入数据库
            if(DB::table('mall_guanggao')->where('id','=',$id)->update($list)){
                // 删除原来的文件
                unlink($request->input('url'));
                return redirect('/guanggao')->with('success','修改成功');
            }else{
                unlink($request->input('url'));
                return redirect('/guanggao')->with('success','修改成功');
            }
            
            
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
        if(DB::table("mall_guanggao")->where('id','=',$id)->delete()){
            return redirect('/guanggao')->with('success','删除成功');
        }
    }

    public function ajax(Request $request){
        // dd($request->all());
        $status['status'] = $request->input('status');
        $id = $request->input('id');
        // dd($status);
        if(DB::table('mall_guanggao')->where('id','=',$id)->update($status)){
            return 1;
        }
    }
}
