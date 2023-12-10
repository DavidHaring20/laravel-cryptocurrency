<?php

namespace App\Http\Controllers;

use App\Models\Cryptocurrency;

use Illuminate\Http\Request;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;


class CryptocurrencyList extends Controller
{
    public static function getCryptocurrencyListWithTargets(): object
    {
        return view('show-cryptocurrency-list', 
            ['cryptocurrencies' => self::getCryptocurrencyList(Config::get('constants.TARGET_KEYS'), 
                                                            Config::get('constants.TRAVERSION_KEYS'))]);
    }

    public static function getCryptocurrencyListRankedPercentChange15m(): object 
    {
        $array = self::getCryptocurrencyList(Config::get('constants.TARGET_KEYS_RANKED_LIST'), 
                                            Config::get('constants.TRAVERSION_KEYS'));
        $collection = collect($array);
        $sorted = $collection->sortByDesc('percent_change_15m');
        $cryptocurrencies = $sorted->slice(0, 10);

        return view('show-cryptocurrency-list-ranked', ['cryptocurrencies' => $cryptocurrencies]);
    }

    public static function cronjob() 
    {
        $array = self::getCryptocurrencyList(Config::get('constants.TARGET_KEYS_RANKED_LIST'), 
                                            Config::get('constants.TRAVERSION_KEYS'));
        foreach ($array as $cryptocurrency)
        {
            if (Cryptocurrency::where('symbol', $cryptocurrency['symbol'])->first())
            {
                echo "update ".$cryptocurrency['name']." ";
                Cryptocurrency::where('symbol', $cryptocurrency['symbol'])
                                ->update([
                                    'price' => $cryptocurrency['price'],
                                    'percent_change_15m' => $cryptocurrency['percent_change_15m']            
                                ]);
            } else 
            {
                echo "new ".$cryptocurrency['name']." ";
                $newCryptocurrency = Cryptocurrency::create([
                    'name' => $cryptocurrency['name'],
                    'symbol' => $cryptocurrency['symbol'],
                    'price' => $cryptocurrency['price'],
                    'percent_change_15m' => $cryptocurrency['percent_change_15m']
                ]);
            }
        }
    }


    public static function getCryptocurrencyList(): array
    {
        try 
        {
            $response = Http::get('https://api.coinpaprika.com/v1/tickers');
            if (!$response->successful()) {
                $response->throw();
            }

            $responseCryptocurrencies = json_decode($response, TRUE);
            $cryptocurrencies = array();

            foreach ($responseCryptocurrencies as $cryptocurrency) 
            {
                $temporaryCryptoccurency = [
                    'id' => $cryptocurrency['id'],
                    'name' => $cryptocurrency['name'],
                    'symbol' => $cryptocurrency['symbol'],
                    'quotes' => $cryptocurrency['quotes']['USD']
                ];

                array_push($cryptocurrencies, $temporaryCryptoccurency);
            }
            return $cryptocurrencies;
        } catch (ConnectException $exception) 
        {   
            throw $exception;
        }
    }
}