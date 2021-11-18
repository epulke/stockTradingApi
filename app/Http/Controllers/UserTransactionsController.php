<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserTransactionsController extends Controller
{
    public function index()
    {
        $transactions = auth()->user()->transactions()->get();
        return view("transactions", ["transactions" => $transactions]);
    }
}
