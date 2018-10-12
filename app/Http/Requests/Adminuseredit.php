<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Adminuseredit extends FormRequest
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
            //规则设置不能为空格
            'password'=>'required'
        ];
    }
    // 自定义错误信息
    public function messages(){
        return[
            'password.required'=>'密码不能为 空 或者 空格'
        ];
    }
}
