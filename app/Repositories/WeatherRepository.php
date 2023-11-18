<?php

namespace App\Repositories;

use App\Dtos\WeatherStoreDto;
use App\Models\Weather;
use App\Repositories\Interfaces\WeatherRepositoryInterface;
use Carbon\Carbon;


class WeatherRepository implements WeatherRepositoryInterface
{

    /**
     * Get weather by city name
     *
     * @param string $cityName
     *
     * @return object|null
     */
    public function show(string $cityName): ?object
    {
        $weather = Weather::where('city_name', $cityName)->first();

        return json_decode($weather?->toJson());
    }

    /**
     * Store weather
     *
     * @param WeatherStoreDto $dto
     *
     * @return int
     */
    public function store(WeatherStoreDto $dto): int
    {
        $data = [
            'city_name'    => $dto->cityName,
            'min_tmp'      => $dto->minTmp,
            'max_tmp'      => $dto->maxTmp,
            'wind_spd'     => $dto->windSpd,
            'timestamp_dt' => $dto->timestampDt,
        ];

        return Weather::updateOrCreate(['city_name' => $dto->cityName], $data)->id;
    }
}
