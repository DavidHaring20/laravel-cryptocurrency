<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CryptocurrencyList extends Controller
{
    public function getCryptocurrencyList() 
    {
        $response = Http::get('https://api.coinpaprika.com/v1/tickers');
        $responseCryptocurrencies = json_decode($response, TRUE);
        $cryptocurrencies = array();

        $keys = ['id', 'name', 'symbol', 'price'];
        $arrayKeys = ['quotes', 'USD'];

        foreach ($responseCryptocurrencies as $cryptocurrency) 
        {
            $temporaryCryptoccurency = [];

            foreach ($cryptocurrency as $key1 => $value1) 
            {
                if (in_array($key1, $keys))
                {
                    $temporaryCryptoccurency[$key1] = $value1; 
                } elseif (in_array($key1, $arrayKeys))
                {
                    foreach ($value1 as $key2 => $value2)  
                    {
                        if (in_array($key2, $arrayKeys)) 
                        {
                            foreach ($value2 as $key3 => $value3) 
                            {
                                if (in_array($key3, $keys)) {
                                    $temporaryCryptoccurency[$key3] = $value3;
                                }
                            }
                        }
                    }
                }
            }

            array_push($cryptocurrencies, $temporaryCryptoccurency);
        }

        return view('show-cryptocurrency-list   ', ['cryptocurrencies' => $cryptocurrencies]);
    }
}
