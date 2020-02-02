<?php

namespace App;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable;

    public $table = 'teachers';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'email',
        'team_id',
        'last_name',
        'first_name',
        'created_at',
        'updated_at',
        'deleted_at',
        'middle_name',
        'phone_number',
    ];

    public function admissionTeacherAttendances()
    {
        return $this->hasMany(TeacherAttendance::class, 'admission_id', 'id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
