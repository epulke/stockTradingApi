<?php

use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserFundsController;
use App\Http\Controllers\UserStocksController;
use App\Http\Controllers\UserTransactionsController;
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

Route::get('/dashboard', [UserDashboardController::class, "index"])
    ->middleware(['auth'])->name('dashboard');

Route::resource("companies", CompaniesController::class);

Route::get("/user/funds", [UserFundsController::class, "index"])->middleware(["auth"])->name("funds");
Route::post("/user/funds", [UserFundsController::class, "deposit"])->middleware(["auth"])->name("deposit");

Route::post("/user/funds/withdraw", [UserFundsController::class, "withdrawAction"])
    ->middleware(["auth"])->name("withdrawAction");

Route::get('/search', function () {
    return view('search');
})->middleware(['auth'])->name('search');

Route::get("/search/results", [CompaniesController::class, "index"])
    ->middleware(["auth"])->name("search.results");

Route::get("/portfolio", [UserStocksController::class, "index"])
    ->middleware(["auth"])->name("portfolio.index");
Route::get("/portfolio/filter", [UserStocksController::class, "filter"])
    ->middleware(["auth"])->name("portfolio.filter");
Route::post("/portfolio/{symbol}", [UserStocksController::class, "buyStock"])
    ->middleware(["auth"])->name("portfolio.buyStock");
Route::put("/portfolio/{symbol}", [UserStocksController::class, "sellStock"])
    ->middleware(["auth"])->name("portfolio.sellStock");

Route::get("/transactions", [UserTransactionsController::class, "index"])
    ->middleware(["auth"])->name("transactions");
Route::get("/transactions/select", [UserTransactionsController::class, "select"])
    ->middleware(["auth"])->name("transactions.select");



require __DIR__.'/auth.php';
