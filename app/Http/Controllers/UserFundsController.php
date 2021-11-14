<?php

namespace App\Http\Controllers;

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
        return view("funds.funds", ["funds" => $funds]);
    }

    public function deposit(UserFundsDepositRequest $request)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $funds = UserFunds::where("user_id", $userId)->firstOrFail();
        $funds->update(["funds" => $funds->funds + $request->get("deposit")]);

        return redirect()->route("funds");
    }

    public function withdrawView()
    {
        $userId = Auth::user()->getAuthIdentifier();
        $funds = UserFunds::where("user_id", $userId)->firstOrFail()->funds;
        return view("funds.withdraw", ["funds" => $funds]);
    }

    public function withdrawAction(UserFundsWithdrawRequest $request)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $funds = UserFunds::where("user_id", $userId)->firstOrFail();
        $funds->update(["funds" => $funds->funds - $request->get("withdraw")]);

        return redirect()->route("funds");
    }
}
