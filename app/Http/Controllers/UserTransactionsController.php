<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionsSelectRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserTransactionsController extends Controller
{
    public function index(): View
    {
        $transactions = auth()->user()->transactions()->orderByDesc("created_at")->paginate(10);
        return view("transactions", ["transactions" => $transactions]);
    }

    public function select(string $type): View
    {
        $transactions = auth()->user()->transactions()->where("transaction_type", $type)
            ->orderByDesc("created_at")->paginate(10);
        return view("transactions", ["transactions" => $transactions]);
    }
}
