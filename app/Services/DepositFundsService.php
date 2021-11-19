<?php

namespace App\Services;

use App\Events\FundsWereDeposited;
use App\Models\User;
use App\Models\UserFunds;
use App\Models\UserTransaction;
use Illuminate\Support\Facades\Auth;

class DepositFundsService
{
    public function execute(int $amount): void
    {
        $userId = Auth::user()->getAuthIdentifier();
        $funds = UserFunds::where("user_id", $userId)->firstOrFail();
        $funds->update(["funds" => $funds->funds + $amount * 100]);

        $user = User::find($userId);

        $userTransaction = new UserTransaction([
            "transaction_type" => "deposit",
            "stock_symbol" => "deposit",
            "amount" => 1,
            "stock_price" => $amount
        ]);
        $userTransaction->user()->associate($user);
        $userTransaction->save();

        event(new FundsWereDeposited($user->email, $amount));
    }
}
