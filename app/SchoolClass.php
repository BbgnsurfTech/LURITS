<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    public $table = 'school_classes';

    protected $fillable = ['ds_class_id', 'ds_arm_id', 'school_id', 'staff_id'];

    public function classTitle()
    {
    	return $this->belongsTo(DsClass::class, 'ds_class_id', 'id');
    }

    public function armTitle()
    {
    	return $this->belongsTo(DsArms::class, 'ds_arm_id', 'id');
    }

    public function school()
    {
    	return $this->belongsTo(School::class);
    }

    public function staffData()
    {
    	return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }
}
