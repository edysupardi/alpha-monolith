<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneNumberRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!empty($value)){
            if(!is_numeric($value)){
                $fail(__('validation.numeric', ['attribute' => $attribute]));
            }

            $minSize = 9;
            if(strlen($value) < $minSize){
                $fail(__('validation.min.numeric', ['attribute' => $attribute, 'min' => $minSize]));
            }

            $maxSize = 20;
            if(strlen($value) > $maxSize){
                $fail(__('validation.max.numeric', ['attribute' => $attribute, 'max' => $maxSize]));
            }

            $pattern = "/(\+62 ((\d{3}([ -]\d{3,})([- ]\d{4,})?)|(\d+)))|(\(\d+\) \d+)|\d{3}( \d+)+|(\d+[ -]\d+)|\d+/";
            if(!preg_match($pattern, $value)){
                $fail(__('validation.phone_number_format', ['attribute' => $attribute, 'format' => __('message.phone_number_format') ]));
            }
        }
    }
}
