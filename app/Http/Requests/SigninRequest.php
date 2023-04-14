<?php

namespace App\Http\Requests;

class SigninRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'email'     => ['bail', 'required', 'email'],
            'password'  => [
                'bail',
                'required',
                'string',
                'min:8',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ]
        ];
    }
}
