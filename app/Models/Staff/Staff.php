<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticate;

class Staff extends Authenticate
{
    use Notifiable;

    protected $table = 'staffs';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function section(){
        return $this->hasMany('App\Models\Section');
    }

    public function class_schedule(){
        return $this->hasMany('App\Models\ClassSchedule');
    } 

    public function staff(){
        return $this->belongsTo('App\Models\School');
    }

    public function email(){
        return $this->hasMany('App\Models\Staff\EMail');
    }  
    
    public function sms(){
        return $this->hasMany('App\Models\Staff\SMS');
    }     
    
    public function getFullNameAttribute()
    {
        $middlename = isset($this->middle_name)?$this->middle_name.' ':'';
        return "{$this->first_name} {$middlename}{$this->other_name}";
    }

}