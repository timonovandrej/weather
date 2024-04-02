<?php

namespace App\Helpers;

use App\Helpers\Interfaces\ApiHelperInterface;
use App\Helpers\Maps\MapStoresTrait;
use Illuminate\Support\Facades\Http;

class MonobankApiHelper implements ApiHelperInterface
{
    use MapStoresTrait;

    const API_URL = 'https://api.monobank.ua/bank/currency';

    public function getCurrencies():array
    {
        $response = Http::get(self::API_URL)?->json();

        if ($response) {
            return $this->mapCurrenciesStoreDto($response);
        }


        return [];
    }

}
