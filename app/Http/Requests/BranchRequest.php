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
            'name'      => ['required'],
            'phone'     => [new PhoneNumberRule],
            'address'   => ['max:255'],
            'is_main'   => ['required', Rule::in(Branch::IS_MAIN, Branch::IS_NOT_MAIN)],
        ];

        if(strtolower($this->method()) == "put"){
            $rules['status'] = ['required', Rule::in(Branch::STATUS_ACTIVE, Branch::STATUS_INACTIVE)];
        };

        return $rules;
    }
}
