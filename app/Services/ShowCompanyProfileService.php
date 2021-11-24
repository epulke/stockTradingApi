<?php

namespace App\Services;

use App\Models\UserFunds;
use App\Models\UserStock;
use App\Repositories\StockRepository;
use Illuminate\Contracts\View\View;


class ShowCompanyProfileService
{
    private StockRepository $repository;

    public function __construct(StockRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id): View
    {
        $companyProfile = $this->repository->getCompanyProfile($id);
        if (!strpos($id, "."))
        {
            $quote = $this->repository->getStockQuote($id);
            $funds = UserFunds::where("user_id", auth()->user()->getAuthIdentifier())->firstOrFail()->funds;
            $amount = UserStock::where("user_id", auth()->user()->getAuthIdentifier())->firstWhere("stock_symbol", $id);
            return view("company.show", [
                "company" => $companyProfile,
                "quote" => $quote->quote,
                "funds" => $funds / 100,
                "amount" => $amount->amount ?? 0
            ]);
        } else {
            return view( "company.forbidden", ["company" => $companyProfile]);
        }
    }
}
