<?php

namespace App\Http\Requests;

class RequestProvienceAll extends BaseRequest
{
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'max:50'],
        ];
    }
}
