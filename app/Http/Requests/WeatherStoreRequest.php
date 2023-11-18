<?php

namespace App\Http\Requests;

use App\Dtos\WeatherStoreDto;
use App\Helpers\Maps\MapWeatherStoreTrait;
use Illuminate\Foundation\Http\FormRequest;

class WeatherStoreRequest extends FormRequest
{
    use MapWeatherStoreTrait;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cityName'    => 'required|string',
            'minTmp'      => 'required|string',
            'maxTmp'      => 'required|string',
            'windSpd'     => 'required|string',
            'timestampDt' => 'required|string',
        ];
    }

    public function getWeatherStoreDto(): WeatherStoreDto
    {
        return $this->mapWeatherStoreDto($this->toObject());
    }

    private function toObject(): object
    {
        $data = (object)$this->all();

        return json_decode(json_encode($data));
    }

}
