<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Str;

class ContainForbiddenWord implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $words = ['hate', 'idiot', 'stupid'];

        if (Str::contains(Str::lower($value), $words)) {
            $fail("validation.forbidden_word")->translate();
        };
    }
}
