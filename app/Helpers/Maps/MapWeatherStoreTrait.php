<?php

namespace App\Helpers\Maps;


use App\Dtos\WeatherStoreDto;
use Carbon\Carbon;
use Illuminate\Support\Str;

trait MapWeatherStoreTrait
{

    public function mapWeatherStoreDto(object $data): WeatherStoreDto
    {
        return new WeatherStoreDto(
            Str::of($data->cityName)->trim(),
            $data->minTmp,
            $data->maxTmp,
            $data->windSpd,
            Carbon::createFromTimestamp($data->timestampDt),
        );
    }

}
