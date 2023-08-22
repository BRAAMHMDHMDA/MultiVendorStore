<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Config;
use NumberFormatter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class Currency
{

//        $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);
//
//        if ($currency===null) $currency = config('app.currency_default');
//
//        return $formatter->formatCurrency($amount, $currency);

//    public function __invoke(...$params): bool|string
//    {
//        return static::format(...$params);
//    }


    public static function format($amount, $currencyCode = null): bool|string
    {
        $defaultCurrencyCode = Config::get('app.currency_default');

        $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);

        if ($currencyCode === null) {
            $currencyCode = Session::get('currency_code', $defaultCurrencyCode);
        }

        $cacheKey = 'currency_rate_'.$currencyCode;
        if ($currencyCode != $defaultCurrencyCode) {
            $rate = Cache::get($cacheKey, 1);
            $amount = $amount * $rate;
        }
        return $formatter->formatCurrency($amount, $currencyCode);
    }

}