<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCode extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->request->get('id');
//        $regexName = regexName();
        $required = [
            'code'     => "required|unique:activation_code,code,$id|min:6|max:6",
            // 'status'    => "required"
        ];

        return $required;
    }

    public function messages()
    {
        return [
            'code.required'     => "Mã kích hoạt bắt buộc",
            'code.unique'      => "Mã kích hoạt không được trùng",
            'code.min'      => "Mã kích hoạt là 6 chữ số",
            'code.max'      => "Mã kích hoạt là 6 chữ số",
        ];
    }
}
