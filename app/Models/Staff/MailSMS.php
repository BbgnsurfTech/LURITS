<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticate;

class MailSMS extends Authenticate
{
    use Notifiable;

    protected $table = 'mailsms';

    protected $fillable = [
        'subject', 'message', 'message_type', 'sender_id', 'receiver_id',
    ];

    public function sender(){
        return $this->belongsTo('App\Staff');
    }

    public function receiver(){
        return $this->belongsTo('App\Staff');
    }
}
