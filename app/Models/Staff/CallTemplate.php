<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticate;

class CallTemplate extends Authenticate
{
    use Notifiable;

    protected $table = 'call_templates';

    protected $fillable = [
        'title', 'file_name',
    ];
}
