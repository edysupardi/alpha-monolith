<?php

namespace App\Http\Requests;

class RequestDistrictAll extends BaseRequest
{
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'max:50'],
            'provience' => [
                'required',
                // Rule::exists('provience', 'id')->whereNull('deleted_at')->where('id', ( !empty($this->input('provience')) ? Crypt::decrypt($this->input('provience')) : null ) ),
            ],
        ];
    }
}
