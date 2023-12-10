<?php 

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

class CryptocurrencyListService 
{
    public function getCryptocurrencyList(): array
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