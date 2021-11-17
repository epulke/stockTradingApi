<?php

namespace App\Http\Controllers;

use App\Events\FundsWereDeposited;
use App\Http\Requests\UserFundsDepositRequest;
use App\Http\Requests\UserFundsWithdrawRequest;
use App\Models\User;
use App\Models\UserFunds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserFundsController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->getAuthIdentifier();
        $funds = UserFunds::where("user_id", $userId)->firstOrFail()->funds;
        return view("funds.funds", ["funds" => $funds/100]);
    }

    public function deposit(UserFundsDepositRequest $request)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $funds = UserFunds::where("user_id", $userId)->firstOrFail();
        $funds->update(["funds" => $funds->funds + $request->get("deposit") * 100]);
        $user = User::find(Auth::user()->getAuthIdentifier())->email;

        // TODO šeit būs jāatjauno to eventu, kad atnāk epasts par deposited amount.
        event(new FundsWereDeposited($user, $request->get("deposit")));

        return redirect()->route("funds");
    }

    public function withdrawView()
    {
        $userId = Auth::user()->getAuthIdentifier();
        $funds = UserFunds::where("user_id", $userId)->firstOrFail()->funds;
        return view("funds.withdraw", ["funds" => $funds/100]);
    }

    public function withdrawAction(UserFundsWithdrawRequest $request)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $funds = UserFunds::where("user_id", $userId)->firstOrFail();
        $funds->update(["funds" => $funds->funds - $request->get("withdraw")*100]);

        return redirect()->route("funds");
    }
}
