<?php

use App\Http\Controllers\CompaniesController;
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

Route::resource("companies", CompaniesController::class);


Route::get("/user/funds", [UserFundsController::class, "index"])->middleware(["auth"])->name("funds");
Route::post("/user/funds", [UserFundsController::class, "deposit"])->middleware(["auth"])->name("deposit");
Route::get("/user/funds/withdraw", [UserFundsController::class, "withdrawView"])
    ->middleware(["auth"])->name("withdrawView");
Route::post("/user/funds/withdraw", [UserFundsController::class, "withdrawAction"])
    ->middleware(["auth"])->name("withdrawAction");

Route::get('/search', function () {
    return view('search');
})->middleware(['auth'])->name('search');

Route::get("/search/results", [CompaniesController::class, "index"])
    ->middleware(["auth"])->name("search.results");

require __DIR__.'/auth.php';
