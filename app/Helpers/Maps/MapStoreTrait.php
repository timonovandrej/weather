<?php

namespace App\Helpers\Maps;

use App\Dtos\Currency\StoreDto;

trait MapStoreTrait
{

    public function mapCurrencyStoreDto(object $data): StoreDto
    {
        return new StoreDto(
            $data->currencyCodeA,
            $data->currencyCodeB,
            $data->date,
            $data->rateBuy ?? '',
            $data->rateSell ?? '',
            $data->rateCross ?? '',
        );
    }

}
