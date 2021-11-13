<?php

use App\Http\Controllers\StocksController;
use App\Http\Controllers\UserFundsController;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource("stocks", StocksController::class);

//Route::get('/user/funds', [UserFundsController::class, 'index'])->name('funds');

Route::view("/user/funds", "funds.funds")->middleware(["auth"])->name("funds");
Route::post("/user/funds", [UserFundsController::class, "deposit"])->middleware(["auth"])->name("deposit");
Route::view("/user/funds/withdraw", "funds.withdraw")->middleware(["auth"])->name("withdraw");

require __DIR__.'/auth.php';
