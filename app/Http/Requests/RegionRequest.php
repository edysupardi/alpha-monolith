<?php

namespace App\Http\Requests;

class RegionRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name'      => ['required'],
        ];
    }
}
