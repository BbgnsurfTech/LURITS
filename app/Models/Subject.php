<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'short_name'];

    public function class_schedule(){
        return $this->hasMany('App\Models\ClassSchedule');
    }
}


