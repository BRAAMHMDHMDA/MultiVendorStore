<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConverter
{
//    private static string $apiKey;
    protected static string $baseUrl = 'https://free.currconv.com/api/v7';

//    public function __construct()
//    {
//        self::$apiKey = config('services.currency_converter.api_key');
//    }

    public static function convert(string $from, string $to, float $amount = 1): float
    {
        $q = "{$from}_{$to}";
        $response = Http::baseUrl(self::$baseUrl)
            ->get('/convert', [
                'q' => $q,
                'compact' => 'y',
                'apiKey' => config('services.currency_converter.api_key'),
            ]);
        $result = $response->json();

        return $result[$q]['val'] * $amount;
    }
}