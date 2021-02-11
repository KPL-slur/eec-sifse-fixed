<?php

namespace App\Services;

class ExchangeRate{
    function apiCall(){
        $ex_rate_api = 'https://api.exchangeratesapi.io/latest?base=USD&symbols=IDR';
        $response = file_get_contents($ex_rate_api);
        $rates = json_decode($response);

        return $rates;
    }
}