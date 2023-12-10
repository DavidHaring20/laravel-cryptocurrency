<?php

namespace App\Http\Controllers;

use App\Models\Cryptocurrency;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CryptocurrencyUpdate extends Controller
{
    public function updateCryptocurrency(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'symbol' => 'required|exists:cryptocurrencies|max:10',
            'price' => 'required|decimal:2,10'
        ]);

        if ($validator->fails()) {
            return redirect('updateCryptocurrency')
                        ->withErrors($validator);
        }
        $validated = $validator->safe()->only(['symbol', 'price']);

        $update = Cryptocurrency::where('symbol', $validated['symbol'])
                            ->update(['price' => $validated['price']]);

        if ($update) {
            Cryptocurrency::where('symbol', $validated['symbol'])
                            ->update(['price_updated' => 1]);
            return view('update-cryptocurrency', ['info' => 'Update successful']);
        } else {
            return view('update-cryptocurrency', ['info' => 'Update unsuccessful']);
        }
    }
}
