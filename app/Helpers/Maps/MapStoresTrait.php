<?php

namespace App\Helpers\Maps;

trait MapStoresTrait
{
    use MapStoreTrait;

    public function mapCurrenciesStoreDto(array $data): array
    {
        $dtos = [];

        foreach ($data as $key => $value) {
            $dtos[] = $this->mapCurrencyStoreDto((object)$value)->toArray();
        }

        return $dtos;
    }

}
