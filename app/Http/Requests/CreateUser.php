<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUser extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user_id = $this->request->get('user_id');
        $regexName = regexName();
        $required = [
            'name'     => "required|min:2|max:255|$regexName",
            'email'    => "required|string|email|max:255|unique:users,email,$user_id",
            'phone'    => "required|unique:users,phone,$user_id|regex:/(0)[0-9]{9}/",
        ];
        if (isset($this->request->all()['password'])) {
            $regexPass = regexPass();
            $required['password'] = "required|string|$regexPass|min:6";
        }
        return $required;
    }
}
