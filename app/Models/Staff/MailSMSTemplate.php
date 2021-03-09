<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticate;

class MailSMSTemplate extends Authenticate
{
    use Notifiable;

    protected $table = 'mailsms_templates';

    protected $fillable = [
        'title', 'message', 'type',
    ];
}
