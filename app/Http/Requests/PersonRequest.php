<?php

namespace App\Http\Requests;

use App\Models\Person;
use Illuminate\Validation\Rule;

class PersonRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'full_name'         => ['required', 'max:255'],
            'place_of_birth'    => ['nullable', 'max:50'],
            'date_of_birth'     => ['nullable', 'date'],
            'gender'            => ['required', Rule::in(Person::GENDER)],
        ];
    }
}
