<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSetting extends Model
{
    protected $table = 'class_settings';
    protected $fillable = ['class_id', 'school_id'];

    public function school(){
        return $this->belongsTo('App\Models\School');
    }

    public function section(){
        return $this->hasMany('App\Models\Section');
    }

    public function class(){
        return $this->belongsTo('App\Models\ClassRoom');
    }
}
