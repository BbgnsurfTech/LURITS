<?php

namespace App;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use SoftDeletes,  Auditable;

    public $table = 'attendances';

    const LATE_STATUS_Y_N_RADIO = [
        '1' => 'Yes',
        '0' => 'No',
    ];


    const ATTENDANCE_STATUS_MORNINIG_RADIO = [
        '1' => 'Present',
        '0' => 'Absent',
    ];

    const ATTENDANCE_STATUS_AFTERNOON_RADIO = [
        '1' => 'Present',
        '0' => 'Absent',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    protected $fillable = [
        'created_at',
        'updated_at',
        'deleted_at',
        'school_id',
        'admission_id',
        'class_id',
        'attendance_morning',
        'attendance_afternoon',
        'late_status',
        'date',
    ];

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
