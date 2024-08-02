<?php

namespace App\Http\Requests;

class EmergencyContactTypeRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name'      => ['required'],
        ];
    }
}
