<?php

namespace App\Http\Requests;

class SigninRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'email'     => ['required', 'email'],
            'password'  => ['required']
        ];
    }
}
