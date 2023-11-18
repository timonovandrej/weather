<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected $table = 'weathers';

    protected $fillable = [
        'city_name',
        'min_tmp',
        'max_tmp',
        'wind_spd',
        'timestamp_dt',
    ];
}
