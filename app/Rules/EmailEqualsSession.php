<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmailEqualsSession implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (session()->missing('email')) {
            return;
        }

        if ($value == session('email')) {
            return;
        }

        $fail('O :attribute verificado deve ser o mesmo que o :attribute preenchido no formulário.');
    }
}
