<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

//use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
//    use HasApiTokens, HasFactory, Notifiable;
    use HasFactory, Notifiable;

    protected $fillable = [
        'login',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
