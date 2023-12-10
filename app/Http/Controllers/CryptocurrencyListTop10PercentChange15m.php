<?php

namespace App\Http\Controllers;

use App\Services\CryptocurrencyListService;
use Illuminate\Http\Request;

class CryptocurrencyListTop10PercentChange15m extends Controller
{
    public function getCryptocurrencyListRankedPercentChange15m(CryptocurrencyListService $cryptocurrencyListService)
    {
        $array = $cryptocurrencyListService->getCryptocurrencyList();
        $collection = collect($array);
        $sorted = $collection->sortByDesc(function ($item) {
            return $item['quotes']['percent_change_15m'];
        });
        $cryptocurrencies = $sorted->slice(0, 10);

        return view('show-cryptocurrency-list-ranked', ['cryptocurrencies' => $cryptocurrencies]);
    }
}
