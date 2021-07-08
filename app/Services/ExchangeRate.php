<?php

namespace App\Services;

class ExchangeRate{
    function apiCall(){
        // $ex_rate_api = 'https://api.exchangeratesapi.io/latest?base=USD&symbols=IDR';
        $ex_rate_api = 'http://data.fixer.io/api/latest?access_key=e0b0f0b42407272fdea14c3dcb556ed9';
        $response = file_get_contents($ex_rate_api);
        $rates = json_decode($response);

        $usd = $rates->rates->USD;
        $idr = $rates->rates->IDR;
        $rate_fix = $idr / $usd;
        $rate_fix = number_format($rate_fix, 2, ".", "");

        return $rate_fix;
    }
}