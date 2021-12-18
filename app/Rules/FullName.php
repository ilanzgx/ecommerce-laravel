<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FullName implements Rule{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        return str_word_count($value) > 1;
    }

    public function message()
    {
        return 'Por favor insira seu nome completo';
    }
}
