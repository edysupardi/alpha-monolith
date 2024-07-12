<?php

namespace App\Http\Requests;

class BranchRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'company'   => ['required', 'exists:company,id'],
            'name'      => ['required'],
            'phone'     => ['max:20'],
            'address'   => ['max:255'],
        ];
    }
}
