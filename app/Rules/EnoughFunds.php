<?php

namespace App\Rules;

use App\Models\UserFunds;
use Illuminate\Contracts\Validation\Rule;

class EnoughFunds implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $funds = UserFunds::where("user_id", auth()->user()->getAuthIdentifier())->firstOrFail();
        if ($value <= $funds->funds)
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
        return 'You do not have enough funds to buy this stock.';
    }
}
