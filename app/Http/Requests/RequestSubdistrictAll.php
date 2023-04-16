<?php

namespace App\Http\Requests;

class RequestSubdistrictAll extends BaseRequest
{
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'max:50'],
            'district' => ['required'],
        ];
    }
}
