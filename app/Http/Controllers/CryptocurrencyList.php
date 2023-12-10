<?php

namespace App\Http\Controllers;

use App\Services\CryptocurrencyListService;

use Illuminate\Http\Request;

class CryptocurrencyList extends Controller
{
    public function getCryptocurrencyList(CryptocurrencyListService $cryptocurrencyListService): object {
        return view('show-cryptocurrency-list', ['cryptocurrencies' => $cryptocurrencyListService->getCryptocurrencyList()]);
    }
}