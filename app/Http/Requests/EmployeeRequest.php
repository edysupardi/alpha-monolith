<?php

namespace App\Http\Requests;

use App\Models\Person;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class EmployeeRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'full_name'         => ['bail', 'required', 'max:255'],
            'gender'            => ['bail', 'required', Rule::in(Person::GENDER)],
            'place_of_birth'    => ['bail', 'nullable', 'max:50'],
            'date_of_birth'     => ['bail', 'nullable', 'date'],
            'identity_type_id'  => ['bail', 'required', Rule::exists('identity_type', 'id')],
            'identity_number'   => ['bail', 'required', 'max:50'],
            'branch_id'         => ['bail', 'required'],
            'username'          => ['bail', 'required']
        ];

        if($this->method() == 'POST'){
            $rules['username'][] = Rule::unique('employee', 'username');
            $rules['password'] = [
                'bail',
                'required',
                'string',
                Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()
            ];
        }

        return $rules;
    }
}
