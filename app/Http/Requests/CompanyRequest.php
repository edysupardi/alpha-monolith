<?php

namespace App\Http\Requests;

use App\Rules\PhoneNumberRule;

class CompanyRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name'      => ['required'],
            'phone'     => [new PhoneNumberRule],
            'address'   => ['max:255'],
        ];
    }
}
