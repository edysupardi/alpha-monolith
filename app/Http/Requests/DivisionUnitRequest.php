<?php

namespace App\Http\Requests;

use App\Models\DivisionUnit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DivisionUnitRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'parent' => ['bail', 'nullable',
                Rule::exists('division_unit', 'id')->where(function (Builder $query) {
                    $user = Auth::user();
                    return $query->where('company_id', $user->company_id);
                })
            ],
            'name'      => ['required'],
            'can_loan'  => ['required', Rule::in(DivisionUnit::CAN_LOAN, DivisionUnit::CANNOT_LOAN)],
        ];

        return $rules;
    }
}
