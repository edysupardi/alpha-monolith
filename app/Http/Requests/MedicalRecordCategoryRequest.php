<?php

namespace App\Http\Requests;

class MedicalRecordCategoryRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name'      => ['required'],
        ];
    }
}
