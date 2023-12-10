<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CryptocurrencyList;
use App\Http\Controllers\CryptocurrencyListTop10PercentChange15m;
use App\Http\Controllers\CryptocurrencyUpdate;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('getCryptocurrencyList', [CryptocurrencyList::class, 'getCryptocurrencyList']);
Route::get('getCryptocurrencyListRankedPercentChange15m', [CryptocurrencyListTop10PercentChange15m::class, 'getCryptocurrencyListRankedPercentChange15m']);

Route::patch('updateCryptocurrency', [CryptocurrencyUpdate::class, 'updateCryptocurrency']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
