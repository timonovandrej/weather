<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Currency extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'codeA',
        'codeB',
        'date',
        'rateBuy',
        'rateSell',
        'rateSell',
        'rateCross',
        'key',
    ];
}
