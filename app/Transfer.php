<?php

namespace App;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transfer extends Model
{
    use SoftDeletes,  Auditable;

    public $table = 'transfers';

    const TRANSFER_STATUS = [
        '0' => 'Not Approved',
        '1' => 'Approved',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'student_id',
        'certificate_number',
        'class_id',
        'last_class_attended',
        'pupils_conduct',
        'reason_for_leaving',
        'last_attendance_date',
        'old_school',
        'new_school',
        'headteacher_name',
        'headteacher_phone',
        'transfer_status',
    ];

    public function student()
    {
        return $this->belongsTo(StudentAdmission::class);
    }

    public function school_enrolled()
    {
        return $this->belongsTo(School::class, 'school_enrolled_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }
}