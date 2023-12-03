<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CryptocurrencyList extends Controller
{
    public static function getCryptocurrencyListWithTargets(): object
    {
        $targetKeys = ['symbol', 'name', 'price'];
        $traversionKeys = ['quotes', 'USD'];

        return view('show-cryptocurrency-list', ['cryptocurrencies' => self::getCryptocurrencyList($targetKeys, $traversionKeys)]);
    }

    public static function getCryptocurrencyListRankedPercentChange15m(): object 
    {
        $targetKeys = ['symbol', 'name', 'price', 'percent_change_15m'];
        $traversionKeys = ['quotes', 'USD'];

        $array = self::getCryptocurrencyList($targetKeys, $traversionKeys);
        $collection = collect($array);
        $sorted = $collection->sortByDesc('percent_change_15m');
        $sliced = $sorted->slice(0, 10);
        $cryptocurrencies = $sliced->all();

        return view('show-cryptocurrency-list-ranked', ['cryptocurrencies' => $cryptocurrencies]);
    }


    public static function getCryptocurrencyList($targetKeys, $traversionKeys): array
    {
        $response = Http::get('https://api.coinpaprika.com/v1/tickers');
        $responseCryptocurrencies = json_decode($response, TRUE);
        $cryptocurrencies = array();

        foreach ($responseCryptocurrencies as $cryptocurrency) 
        {
            $temporaryCryptoccurency = [];

            foreach ($cryptocurrency as $key1 => $value1) 
            {
                if (in_array($key1, $targetKeys))
                {
                    $temporaryCryptoccurency[$key1] = $value1; 
                } elseif (in_array($key1, $traversionKeys))
                {
                    foreach ($value1 as $key2 => $value2)  
                    {
                        if (in_array($key2, $traversionKeys)) 
                        {
                            foreach ($value2 as $key3 => $value3) 
                            {
                                if (in_array($key3, $targetKeys)) {
                                    $temporaryCryptoccurency[$key3] = $value3;
                                }
                            }
                        }
                    }
                }
            }
            array_push($cryptocurrencies, $temporaryCryptoccurency);
        }

        return $cryptocurrencies;
    }
}