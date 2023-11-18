<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class WeatherGetRequest extends FormRequest
{

    public function rules()
    {
        return [
            'cityName' => 'required|string',
        ];
    }

    public function getCityName(): string
    {
        return Str::of($this->cityName)->trim();
    }

}
