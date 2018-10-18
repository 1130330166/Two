<?php

namespace App\Http\Controllers\Admin\Goods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data=DB::table("mall_goods")->paginate(3);
        // dd($data);die;
        foreach ($data as $key => $value) {
            $name=DB::table("mall_cates")->where("id",'=',$value->cate_id)->first();
            $data[$key]->catename=$name->name;

        }
        $i=1;
        // var_dump($data);die;
        //加载商品列表
        return view("Admin.Goods.index",['data'=>$data,'i'=>$i]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $data=DB::table("mall_cates")->select(DB::raw("*,concat(path,',',id) as paths"))->orderBy("paths")->get();
        // echo "<pre>";
        // var_dump($data);die;
        // 加载商品添加模板分配数据
        return view("Admin.Goods.add",['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());die;
        $data['name']=$request->input('name');
        $data['cate_id']=$request->cate_id;
        $data['price']=$request->input('price');
        $data['des']=$request->input('des');
        $data['num']=$request->input('num');
        $data['title']=$request->input('title');
        $data['color']=$request->input('color');
        $data['size']=$request->input('size');
        $data['status']=1;
        if($request->hasfile('pic')){
            //初始化名字
            $name = time()+rand(10000,10000000);
            //获得文件后缀
            $arr = $request->file('pic')->getClientOriginalExtension();
            // dd($arr);
            // dd(date(time()));
            // dd($list);
            //移动到指定的位置
            $request->file('pic')->move('./uploads/goods/'.date('Y-m-d',time()).'',$name.'.'.$arr);
            //设置图片的地址
            $data['pic'] = './uploads/goods/'.date('Y-m-d',time()).'/'.$name.'.'.$arr;
            //设置创键时间
            $data['time'] = date("Y-m-d H:i:s",time());
            // dd($data);die;
            if(DB::table('mall_goods')->insert($data)){
                // return "OK";
                return redirect('/goods')->with('success','商品添加成功');
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
        // echo $id;die;
        $data1=DB::table('mall_goods')->where("id",'=',$id)->first();
        $data=DB::table("mall_cates")->select(DB::raw("*,concat(path,',',id) as paths"))->orderBy("paths")->get();
        // var_dump($data1);die;
        // var_dump($data);die;
        //加载修改模板
        return view("Admin.Goods.edit",['data'=>$data,'data1'=>$data1]);
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
        $data=$request->except('_method','_token');
        // var_dump($data);die;
        if($request->hasfile('pic')){
            //初始化名字
            $name = time()+rand(10000,10000000);
            //获得文件后缀
            $arr = $request->file('pic')->getClientOriginalExtension();
            // dd($arr);
            // dd(date(time()));
            // dd($list);
            //移动到指定的位置
            $request->file('pic')->move('./uploads/goods/'.date('Y-m-d',time()).'',$name.'.'.$arr);
            //设置图片的地址
            $list['pic'] = './uploads/goods/'.date('Y-m-d',time()).'/'.$name.'.'.$arr;
            //设置创键时间
            $list['time'] = date("Y-m-d H:i:s",time());
            // 去除原来的图片地址还有时间
            $data=$request->except('pic','_method','_token','time');
            if($data['status']=='上架'){
	        	$data['status']=1;
	        }else{
	        	$data['status']=0;
	        }
            // 把修改图片后的地址和时间的数组和原来的数组合并
            $arr1=array_merge($data,$list);
            // var_dump($arr1);die;
            // 进库
            if(DB::table('mall_goods')->where("id",'=',$id)->update($arr1)){
                return redirect('/goods')->with('success','商品修改成功');
            }
        }else{
            // 没新上传图片则走原来的数组
            $arr2=$request->except('_method','_token');
            if($arr2['status']=='上架'){
	        	$arr2['status']=1;
	        }else{
	        	$arr2['status']=0;
	        }
                // var_dump($arr2);die;
            // 进库
            if(DB::table('mall_goods')->where("id",'=',$id)->update($arr2)){
                return redirect('/goods')->with('success','商品修改成功');
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
        // echo $id;
        $info=DB::table("mall_goods")->where("id",'=',$id)->first();
        if(DB::table("mall_goods")->where("id",'=',$id)->delete()){
            unlink($info->pic);
            return redirect("/goods")->with("success",'删除成功');
        }
    }
    // 商品用ajax修改状态
    public function ajax(Request $request){
        // dd($request->all());
        $status['status'] = $request->input('status');
        $id = $request->input('id');
        // var_dump($id);
        // var_dump($status);die;
        if(DB::table('mall_goods')->where('id','=',$id)->update($status)){
            return 1;
        }
    }
}
