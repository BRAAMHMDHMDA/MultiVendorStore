<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Services\CurrencyConverter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class CurrencyConverterController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
           'currency_code' => 'required|string|size:3'
        ]);

        $currencyCode = $request->input('currency_code');
        Session::put('currency_code', $currencyCode);
        $defaultCurrencyCode = Config::get('app.currency_default');

        $cacheKey = 'currency_rate_'.$currencyCode;
        $rate = Cache::get($cacheKey);
        if (!$rate){
            $rate = CurrencyConverter::convert($defaultCurrencyCode, $currencyCode);
            Cache::put($cacheKey, $rate, now()->addMinutes(60));
        }

        return redirect()->back();
    }
}
