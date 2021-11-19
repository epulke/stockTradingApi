<?php

namespace App\Http\Controllers;

use App\Events\FundsWereDeposited;
use App\Http\Requests\UserFundsDepositRequest;
use App\Http\Requests\UserFundsWithdrawRequest;
use App\Models\User;
use App\Models\UserFunds;
use App\Models\UserTransaction;
use App\Services\DepositFundsService;
use App\Services\WithdrawFundsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserFundsController extends Controller
{
    private DepositFundsService $depositFundsService;
    private WithdrawFundsService $withdrawFundsService;

    public function __construct(
        DepositFundsService $depositFundsService,
        WithdrawFundsService $withdrawFundsService
    )
    {
        $this->depositFundsService = $depositFundsService;
        $this->withdrawFundsService = $withdrawFundsService;
    }


    public function index(): View
    {
        $userId = Auth::user()->getAuthIdentifier();
        $funds = UserFunds::where("user_id", $userId)->firstOrFail()->funds;
        return view("funds.funds", ["funds" => $funds/100]);
    }

    public function deposit(UserFundsDepositRequest $request): RedirectResponse
    {
        $this->depositFundsService->execute($request->get("deposit"));

        return redirect()->route("funds");
    }


    public function withdrawAction(UserFundsWithdrawRequest $request): RedirectResponse
    {
        $this->withdrawFundsService->execute($request->get("withdraw"));

        return redirect()->route("funds");
    }
}
