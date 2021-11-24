<?php

namespace App\Rules;

use App\Models\UserFunds;
use App\Repositories\StockRepository;
use Illuminate\Contracts\Validation\Rule;

class EnoughFunds implements Rule
{

    private StockRepository $repository;

    public function __construct(StockRepository $repository)
    {
        $this->repository = $repository;
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
        $symbol = str_replace("portfolio/", "", request()->path());
        $quote = $this->repository->getStockQuote($symbol)->quote;
        if ($value * $quote <= $funds->funds / 100)
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
