<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidGenre implements Rule{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        if($value === 'Selecione seu genero'){
            return false;
        } else {
            return true;
        }
    }
    
    public function message()
    {
        return 'Selecione um gênero válido.';
    }
}
