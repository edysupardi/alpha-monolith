<?php

namespace App\Http\Requests;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class IcdRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'parent'    => ['bail', 'nullable',
                Rule::exists('icd', 'id')->where(function (Builder $query) {
                    $user = Auth::user();
                    return $query->where('company_id', $user->company_id);
                })
            ],
            'name'      => ['bail', 'required', 'max:255'],
            'group'     => ['nullable', 'max:50'],
        ];

        if(strtolower($this->method()) == "post"){
            $rules['icd'] = ['bail', 'required', 'unique:icd,icd', 'max:10'];
        }

        return $rules;
    }
}
