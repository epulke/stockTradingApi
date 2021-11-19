<?php

namespace App\Rules;

use App\Http\Requests\BuyStockRequest;
use App\Models\UserFunds;
use App\Repositories\FinnhubModelRepository;
use App\Repositories\StockRepository;
use App\Services\BuyStockService;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class EnoughFunds implements Rule
{

    private StockRepository $repository;
    private BuyStockRequest $request;

    public function __construct(StockRepository $repository, BuyStockRequest $request)
    {
        $this->repository = $repository;
        $this->request = $request;
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
        $symbol = str_replace("portfolio/", "", $this->request->path());
        $quote = $this->repository->getStockQuote($symbol);
        if ($value * $quote <= $funds->funds)
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
