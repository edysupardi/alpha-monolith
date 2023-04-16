<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class RequestDistrictAll extends BaseRequest
{
    public function rules(): array
    {
        return [
            'search' => ['nullable'],
            'provience' => [
                'required',
                // Rule::exists('provience', 'id')->whereNull('deleted_at')->where('id', ( !empty($this->input('provience')) ? Crypt::decrypt($this->input('provience')) : null ) ),
            ],
        ];
    }
}
