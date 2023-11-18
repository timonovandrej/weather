<?php

namespace App\Dtos;

class WeatherStoreDto
{
    public function __construct(
        public string $cityName,
        public string $minTmp,
        public string $maxTmp,
        public string $windSpd,
        public string $timestampDt,
    ) {
    }
}
