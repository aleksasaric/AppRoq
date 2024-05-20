<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class HasNameRule implements ValidationRule
{
    public function __construct(readonly string $name)
    {

    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        Str::contains($this->name, $value->getClientOriginalName());
        if (!Str::contains($this->name, $value->getClientOriginalName())) {
            $fail('The :attribute must have name: ' . $this->name);
        }
    }
}
