<?php

namespace App\Rules;

use App\Models\User;
use App\Models\UserStock;
use Illuminate\Contracts\Validation\Rule;

class EnoughStocksToSell implements Rule
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
        $symbol = str_replace("portfolio/", "", request()->path());
        $userId = auth()->user()->getAuthIdentifier();
        $userAmount = UserStock::where("user_id", $userId)->firstWhere("stock_symbol", $symbol)->amount;
        if ($value > $userAmount) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You do not have that many stocks to sell.';
    }
}
