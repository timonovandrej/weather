<?php

namespace Tests\Unit\Helpers\Maps;

use App\Helpers\Maps\MapStoresTrait;
use Tests\BaseTestCase;

class MapStoresTraitTest extends BaseTestCase
{
    use MapStoresTrait;

    /**
     * Check correct dtos mapping
     */
    public function testMapDtos()
    {
        $stub = $this->getStubData();
        $dtos  = $this->mapCurrenciesStoreDto($stub);

        $this->assertNotEmpty($dtos);
        $this->assertCount(3, $dtos);
    }

    private function getStubData(): array
    {
        return [
            [
                'currencyCodeA' => 840,
                'currencyCodeB' => 980,
                'date'          => 1712005273,
                'rateBuy'       => 38.95,
                'rateSell'      => 39.3592,
                'rateCross'     => 0.0141,
            ],
            [
                'currencyCodeA' => 840,
                'currencyCodeB' => 980,
                'date'          => 1712005273,
            ],
            [
                'currencyCodeA' => 840,
                'currencyCodeB' => 980,
                'date'          => 1712005273,
            ]
        ];
    }
}
