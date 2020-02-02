<?php

namespace App;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable;

    public $table = 'teams';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const CODE_TYPE_SECTOR_SELECT = [
        '1' => 'Pre-Primary and Primary',
        '2' => 'Junior Secondary',
        '3' => 'Senior Secondary',
        '4' => 'Private Education',
        '5' => 'Science and Vocational',
        '6' => 'IQS',
    ];

    protected $fillable = [
        'name',
        'ward',
        'team_id',
        'updated_at',
        'deleted_at',
        'created_at',
        'nemis_code',
        'pseudo_code',
        'village_town',
        'email_address',
        'latitude_north',
        'longitude_east',
        'school_community',
        'school_telephone',
        'code_type_sector',
        'number_and_street',
        'nearby_name_school',
    ];

    public function teamUsers()
    {
        return $this->hasMany(User::class, 'team_id', 'id');
    }

    public function teamTeams()
    {
        return $this->hasMany(Team::class, 'team_id', 'id');
    }

    public function schoolEnrolledStudentAdmissions()
    {
        return $this->hasMany(StudentAdmission::class, 'school_enrolled_id', 'id');
    }

    public function teamAttendances()
    {
        return $this->hasMany(Attendance::class, 'team_id', 'id');
    }

    public function teamTeachers()
    {
        return $this->hasMany(Teacher::class, 'team_id', 'id');
    }

    public function teamTeacherAttendances()
    {
        return $this->hasMany(TeacherAttendance::class, 'team_id', 'id');
    }

    public function teamStudentAdmissions()
    {
        return $this->hasMany(StudentAdmission::class, 'team_id', 'id');
    }

    public function teamParentGuardianregisters()
    {
        return $this->belongsToMany(ParentGuardianregister::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
