<?php

namespace App\Http\Requests;

class SigninRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'username'  => ['required'],
            'password'  => ['required']
        ];
    }
}
