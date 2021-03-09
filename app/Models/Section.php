<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'sections';
    protected $fillable = ['name', 'class_id', 'school_id', 'staff_id', 'title'];

    public function class(){
        return $this->belongsTo('App\Models\ClassRoom');
    }
    public function class_schedule(){
        return $this->hasMany('App\Models\ClassSchedule');
    }
    public function staff(){
        return $this->belongsTo('App\Models\Staff\Staff');
    }

    public function scopeOfClass($query, $class)
    {
        return $query->whereClassId($class);
    }
}
