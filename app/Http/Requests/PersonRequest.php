<?php

namespace App\Http\Requests;

use App\Models\Person;
use Illuminate\Validation\Rule;

class PersonRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'full_name'         => ['bail', 'required', 'max:255'],
            'place_of_birth'    => ['bail', 'nullable', 'max:50'],
            'date_of_birth'     => ['bail', 'nullable', 'date'],
            'gender'            => ['bail', 'required', Rule::in(Person::GENDER)],
            'identity_type_id'  => ['bail', 'required', Rule::exists('identity_type', 'id')],
            'identity_number'   => ['bail', 'required', 'max:50'],
        ];
    }

    public function attributes()
    {
        return [
            'identity_type_id' => 'identity type'
        ];
    }
}
