<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFundsRequest;
use Illuminate\Support\Facades\Auth;

class UserFundsController extends Controller
{
    public function deposit(UserFundsRequest $request)
    {
        var_dump($request->get("deposit"));
        Auth::user()->wallet;
        return view("funds.funds");
    }
}
