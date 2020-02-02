<?php

namespace App;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherAttendance extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable;

    public $table = 'teacher_attendances';

    const LATE_STATUS_Y_N_RADIO = [
        '1' => 'Yes',
        '0' => 'No',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const ATTENDANCE_STATUS_MORNINIG_RADIO = [
        '1' => 'Present',
        '2' => 'Absent',
    ];

    const ATTENDANCE_STATUS_AFTERNOON_RADIO = [
        '1' => 'Present',
        '2' => 'Absent',
    ];

    protected $fillable = [
        'team_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'admission_id',
        'late_status_y_n',
        'attendance_status_morninig',
        'attendance_status_afternoon',
    ];

    public function admission()
    {
        return $this->belongsTo(Teacher::class, 'admission_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
