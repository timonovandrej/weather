<?php

namespace Tests\Stub;

use App\Dtos\WeatherStoreDto;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait StubWeather
{
    public function stubAddWeathers(): void
    {
        $values = [
            [
                'city_name'    => 'test-city-1',
                'min_tmp'      => 12.2,
                'max_tmp'      => 33.2,
                'wind_spd'     => 15.6,
                'timestamp_dt' => Carbon::create(2020, 10, 25, 12, 00),
                'created_at'   => Carbon::create(2000, 10, 25, 10, 00),
                'updated_at'   => Carbon::create(2000, 10, 25, 10, 00),
            ],
            [
                'city_name'    => 'test-city-2',
                'min_tmp'      => 14.2,
                'max_tmp'      => 35.2,
                'wind_spd'     => 2.6,
                'timestamp_dt' => Carbon::create(2020, 10, 25, 12, 00),
                'created_at'   => Carbon::create(2000, 10, 25, 12, 00),
                'updated_at'   => Carbon::create(2000, 10, 25, 12, 00),
            ],
            [
                'city_name'    => 'test-city-3',
                'min_tmp'      => -14.2,
                'max_tmp'      => 2.2,
                'wind_spd'     => 2.6,
                'timestamp_dt' => Carbon::create(2020, 10, 25, 12, 00),
                'created_at'   => Carbon::create(2000, 10, 25, 12, 00),
                'updated_at'   => Carbon::create(2000, 10, 25, 12, 00),
            ],
        ];

        DB::table('weathers')->insert($values);
    }

    public function stubRemoveWeathers(): void
    {
        DB::table('weathers')->whereNotNull('id')->delete();
        DB::statement('ALTER TABLE weathers AUTO_INCREMENT = 1');
    }

    public function getStubWeatherStoreDto(): WeatherStoreDto
    {
        return
            new WeatherStoreDto(
                'test-city-1',
                12.2,
                33.2,
                15.6,
                Carbon::create(2020, 10, 25, 12, 00),
            );
    }

    public function getStubWeatherEditDto(): WeatherStoreDto
    {
        $dto = $this->getStubWeatherStoreDto();
        $dto->minTmp = -100;

        return $dto;
    }

    public function getStubWeatherEditLowerCaseDto(): WeatherStoreDto
    {
        $dto = $this->getStubWeatherStoreDto();
        $dto->minTmp = -100;
        $dto->cityName = 'test-CITY-1';

        return $dto;
    }
}
