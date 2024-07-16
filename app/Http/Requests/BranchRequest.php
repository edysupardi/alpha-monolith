<?php

namespace App\Http\Requests;

use App\Models\Branch;
use App\Rules\PhoneNumberRule;
use Illuminate\Validation\Rule;

class BranchRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'name'      => ['bail', 'required'],
            'phone'     => ['bail', 'nullable', new PhoneNumberRule],
            'address'   => ['bail', 'nullable', 'max:255'],
            'is_main'   => ['bail', 'required', Rule::in(Branch::IS_MAIN, Branch::IS_NOT_MAIN)],
        ];

        if(strtolower($this->method()) == "put"){
            $rules['status'] = ['bail', 'required', Rule::in(Branch::STATUS_ACTIVE, Branch::STATUS_INACTIVE)];
        };

        return $rules;
    }
}
