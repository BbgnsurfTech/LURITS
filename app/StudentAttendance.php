<?php

namespace App;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentAttendance extends Model
{	
	use SoftDeletes,  Auditable;
	
    protected $fillable = array('student_id', 'class_id', 'section_id', 'date', 'attendance');

    public function admission()
    {
        return $this->belongsTo(StudentAdmission::class, 'admission_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function class()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }
}
