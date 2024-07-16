<?php

namespace App\Http\Requests;

class AddressTypeRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name'      => ['required'],
        ];
    }
}
