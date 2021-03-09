<?php

namespace App\Models\Parents;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticate;

class Parents extends Authenticate
{
    use Notifiable;

    protected $guard = 'parents';

    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'email', 'password','gender', 'date_of_birth', 'phone_number', 'address', 'profession', 'photo',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}