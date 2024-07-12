<?php

namespace App\Http\Requests;

class CompanyRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name'      => ['required'],
            'phone'     => ['max:20'],
            'address'   => ['max:255'],
        ];
    }
}
