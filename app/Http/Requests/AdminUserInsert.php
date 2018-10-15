<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserInsert extends FormRequest
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
            //会员名做规则
            // 不能重复
            'name'=>'unique:mall_admin_users',
            'password'=>'required|regex:/\S/'
        ];
    }
    // 自定义错误信息
    public function messages(){
        return[
        'name.unique'=>'用户名不能重复',
        'password.required'=>'密码不能为空',
        'password.regex'=>'密码不能为空或者空格',
        ];
    }
}
