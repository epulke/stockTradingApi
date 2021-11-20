<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTransactionsController extends Controller
{
    public function index()
    {
        $transactions = auth()->user()->transactions()->orderByDesc("created_at")->paginate(10);
        return view("transactions", ["transactions" => $transactions]);
    }
}
