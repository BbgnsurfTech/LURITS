<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticate;

class Call extends Authenticate
{
    use Notifiable;

    protected $table = 'calls';

    protected $fillable = [
        'template_id', 'caller_id', 'callee_id',
    ];
 
    public function caller(){
        return $this->belongsTo('App\Models\Staff\Staff', 'caller_id');
    }

    public function callee(){
        return $this->belongsTo('App\Models\Staff\Staff', 'callee_id');
    }
}
