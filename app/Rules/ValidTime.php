<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidTime implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (now()->hour >= 14 && now()->hour < 21)
        {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Sorry, the market is closed.';
    }
}
