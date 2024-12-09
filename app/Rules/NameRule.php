<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NameRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿ\s]+$/', $value)){
		// if(!preg_match('/^[a-zA-Z]+(?:\s[a-zA-Z]+)+$/', $value)){
			$fail('The :attribute must contains only alphabets.');
		}
    }
}
