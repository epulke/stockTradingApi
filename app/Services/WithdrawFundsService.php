<?php

namespace App\Services;

use App\Events\FundsWereWithdrawn;
use App\Models\User;
use App\Models\UserFunds;
use App\Models\UserTransaction;
use Illuminate\Support\Facades\Auth;

class WithdrawFundsService
{
    public function execute(int $amount)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $funds = UserFunds::where("user_id", $userId)->firstOrFail();
        $funds->update(["funds" => $funds->funds - $amount * 100]);
        $user = User::find($userId);

        $userTransaction = new UserTransaction([
            "transaction_type" => "withdrawal",
            "stock_symbol" => "withdrawal",
            "amount" => 1,
            "stock_price" => $amount
        ]);
        $userTransaction->user()->associate($user);
        $userTransaction->save();

        event(new FundsWereWithdrawn($user->email, $amount));
    }
}
