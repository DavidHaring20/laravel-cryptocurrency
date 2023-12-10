<?php

namespace App\Console\Commands;

use App\Models\Cryptocurrency;
use App\Services\CryptocurrencyListService;
use Illuminate\Console\Command;

class UpdateCryptocurrencyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    # protected $signature = 'app:update-cryptocurrency-command';
    protected $signature = 'cryptocurrency:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates new cryptocurrencies and updates cryptocurrency price and percent_change_15m on existing ones.';

    /**
     * Execute the console command.
     */
    public function handle(CryptocurrencyListService $cryptocurrencyListService)
    {
        $array = $cryptocurrencyListService->getCryptocurrencyList();
        foreach ($array as $cryptocurrency)
        {
            $cryptocurrencyFromDB = Cryptocurrency::where('symbol', $cryptocurrency['symbol'])->first();
            
            if ($cryptocurrencyFromDB === null) 
            {
                // If cryptocurrency doesn't exist
                Cryptocurrency::create([
                    'name' => $cryptocurrency['name'],
                    'symbol' => $cryptocurrency['symbol'],
                    'price' => $cryptocurrency['quotes']['price'],
                    'percent_change_15m' => $cryptocurrency['quotes']['percent_change_15m']
                ]);  
            } elseif ($cryptocurrencyFromDB->price_updated === 0) 
            {
                // If cryptocurrency exists and hasn't been edited
                $cryptocurrencyFromDB->price = $cryptocurrency['quotes']['price'];
                $cryptocurrencyFromDB->percent_change_15m = $cryptocurrency['quotes']['percent_change_15m'];
                $cryptocurrencyFromDB->save();
            } 
            else 
            {
                // If cryptocurrency exists and has been edited
                $cryptocurrencyFromDB->percent_change_15m = $cryptocurrency['quotes']['percent_change_15m'];
                $cryptocurrencyFromDB->save();
            }
        }

        $this->info('Success');
    }
}
