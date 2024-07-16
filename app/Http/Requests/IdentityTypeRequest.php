<?php

namespace App\Http\Requests;

class IdentityTypeRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name'      => ['required'],
        ];
    }
}
