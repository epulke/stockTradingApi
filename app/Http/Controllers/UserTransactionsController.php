<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;


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
