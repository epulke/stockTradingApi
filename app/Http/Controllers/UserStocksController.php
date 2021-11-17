<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyStockRequest;
use App\Models\User;
use App\Models\UserStock;
use Illuminate\Http\Request;

class UserStocksController extends Controller
{
    public function index()
    {
        $stocks = UserStock::find(auth()->user());
        return view("portfolio", ["stocks" => $stocks]);
    }

//    public function buyStock(BuyStockRequest $request)
//    {
//
//    }
}
