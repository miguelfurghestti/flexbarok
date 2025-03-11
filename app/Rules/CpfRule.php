<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule;

class CpfRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        if (is_null($value)) {
            return; // Permite null (nullable)
        }

        $cleanCpf = preg_replace('/[^0-9]/', '', $value);
        if (strlen($cleanCpf) !== 11) {
            $fail('O campo :attribute deve conter 11 dígitos numéricos.');
        }
    }
}
