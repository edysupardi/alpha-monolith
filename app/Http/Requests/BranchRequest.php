<?php

namespace App\Http\Requests;

class BranchRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name'          => ['bail', 'required', 'string', 'max:255'],
            'phone_number'  => ['bail', 'required', 'max:20'],
            'provience'     => ['bail', 'required'],
            'district'      => ['bail', 'required'],
            'subdistrict'   => ['bail', 'required'],
            'village'       => ['bail', 'required'],
            'zip_code'      => ['bail', 'required', 'numeric', 'digits:5'],
            'address'       => ['bail', 'required', 'string'],
        ];
    }
}
