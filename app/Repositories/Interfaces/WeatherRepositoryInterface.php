<?php

namespace App\Repositories\Interfaces;

use App\Dtos\WeatherStoreDto;
use App\Models\Weather;
use Illuminate\Database\Eloquent\Collection;

interface WeatherRepositoryInterface
{

    /**
     * Get weathers by city name
     *
     * @param string $cityName
     *
     * @return object|null
     */
    public function show(string $cityName): ?object;

    /**
     * Store weather
     *
     * @param WeatherStoreDto $dto
     *
     * @return int
     */
    public function store(WeatherStoreDto $dto): int;

}
