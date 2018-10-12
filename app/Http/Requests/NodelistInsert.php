<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NodelistInsert extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //权限名 控制器名 和 方法名 不能重复
            'name'=>'unique:mall_node|required|regex:/\S/',
            'mname'=>'required|regex:/\S/',
            'cname'=>'regex:/\S/'

        ];
    }
    // 自定义提示信息
    public function messages(){
        return[
            'name.unique'=>'权限名不能重复',
            'name.regex'=>'控制器名不能为空或者包含空格',
            'mname.regex'=>'控制器名不能为空或者包含空格',
            'cname.regex'=>'控制器名不能为空或者包含空格',
            'name.required'=>'权限名不能为空',
            'mname.required'=>'控制器名不能为空',
        ];
    }
}
