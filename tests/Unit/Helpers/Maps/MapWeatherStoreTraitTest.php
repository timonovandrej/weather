<?php

namespace Tests\Unit\Helpers\Maps;

use App\Helpers\Maps\MapWeatherStoreTrait;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Tests\BaseTestCase;

class MapWeatherStoreTraitTest extends BaseTestCase
{
    use MapWeatherStoreTrait;

    /**
     * Dto is ready. City with trim
     */
    public function testMapDtoTrim()
    {
        $stub = $this->getStubDataTrim();
        $dto = $this->mapWeatherStoreDto($stub);

        $this->checkDto($dto);
    }

    /**
     * Dto is ready. City no trim
     */
    public function testMapDto()
    {
        $stub = $this->getStubData();
        $dto = $this->mapWeatherStoreDto($stub);

        $this->checkDto($dto);
    }

    private function checkDto($dto) {
        $this->assertEquals('Test city name', $dto->cityName);
        $this->assertEquals(-10, $dto->minTmp);
        $this->assertEquals(52, $dto->maxTmp);
        $this->assertEquals(15.6, $dto->windSpd);
        $this->assertEquals('2023-11-18 12:00:00', $dto->timestampDt);
    }

    private function getStubDataTrim(): object
    {
        $data = $this->getStubData();
        $data->cityName =  '  Test city name   ';

        return $data;
    }

    private function getStubData(): object
    {
        return (object)[
            'cityName' => 'Test city name',
            'minTmp' => -10,
            'maxTmp' => 52,
            'windSpd' => 15.6,
            'timestampDt' => 1700308800
        ];
    }
}
