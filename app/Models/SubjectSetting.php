<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectSetting extends Model
{
    protected $fillable = ['subject_id', 'school_id'];

    public function class_schedule(){
        return $this->hasMany('App\Models\ClassSchedule');
    }

    public function school(){
        return $this->belongsTo('App\Models\School');
    }

    public function section(){
        return $this->hasMany('App\Models\Section');
    }

    public function subject(){
        return $this->belongsTo('App\Models\Subject');
    }

}


