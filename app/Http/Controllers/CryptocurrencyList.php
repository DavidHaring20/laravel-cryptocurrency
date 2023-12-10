<?php

namespace App\Http\Controllers;

use App\Services\CryptocurrencyListService;

use Illuminate\Http\Request;

class CryptocurrencyList extends Controller
{
    public function getCryptocurrencyList(CryptocurrencyListService $cryptocurrencyListService): object {
        return view('show-cryptocurrency-list', ['cryptocurrencies' => $cryptocurrencyListService->getCryptocurrencyList()]);
    }
    // public static function cronjob() 
    // {
    //     $array = self::getCryptocurrencyList(Config::get('constants.TARGET_KEYS_RANKED_LIST'), 
    //                                         Config::get('constants.TRAVERSION_KEYS'));
    //     foreach ($array as $cryptocurrency)
    //     {
    //         if (Cryptocurrency::where('symbol', $cryptocurrency['symbol'])->first())
    //         {
    //             echo "update ".$cryptocurrency['name']." ";
    //             Cryptocurrency::where('symbol', $cryptocurrency['symbol'])
    //                             ->update([
    //                                 'price' => $cryptocurrency['price'],
    //                                 'percent_change_15m' => $cryptocurrency['percent_change_15m']            
    //                             ]);
    //         } else 
    //         {
    //             echo "new ".$cryptocurrency['name']." ";
    //             $newCryptocurrency = Cryptocurrency::create([
    //                 'name' => $cryptocurrency['name'],
    //                 'symbol' => $cryptocurrency['symbol'],
    //                 'price' => $cryptocurrency['price'],
    //                 'percent_change_15m' => $cryptocurrency['percent_change_15m']
    //             ]);
    //         }
    //     }
    // }
}