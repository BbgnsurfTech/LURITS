<?php

namespace App;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Staff extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait, Auditable;

    public $table = 'staffs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'staff_picture',
        'staff_document',
    ];

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'address',
        'phone_number',
        'date_of_birth',
        'marital_status_id',
        'state_of_origin_id',
        'lga_of_origin_id',
        'disability_id',
        'gender_id',
        'type_staff_id',
        'present_status_id',
        'academic_qualification_id',
        'teaching_type_id',
        'sector_id',
        'salary_source_id',
        'year_first_appointment',
        'year_present_appointment',
        'year_posting_to_school',
        'grade_step',
        'term_id',
        'session_id',
        'school_id',
        'teaching_qualification_id',
        'area_of_specialization_id',
        'subject_of_qualification_id',
        'main_subject_taught_id',
        'seminar_workshop_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'teaching_type_part_time',
    ];

    public function getStaffPictureAttribute()
    {
        $file = $this->getMedia('staff_picture')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            //$file->thumbnail = $file->getUrl('thumb');
        }

        return $file;
    }

    public function getStaffDocumentAttribute()
    {
        return $this->getMedia('staff_document');
    }

    public function teaching_type_part_time()
    {
        return $this->belongsTo(DsTeachingTypePartTime::class, 'teaching_type_part_time', 'id');
    }
    
    public function type_staff()
    {
        return $this->belongsTo(DsTypeStaff::class, 'type_staff_id', 'id');
    }

    public function maritalstatus()
    {
        return $this->belongsTo(DsMaritalStatus::class, 'marital_status_id');
    }

    public function disability()
    {
        return $this->belongsTo(DsDisability::class, 'disability_id', 'id');
    }

    public function salary_source()
    {
        return $this->belongsTo(DsSalarySource::class, 'salary_source_id');
    }

    public function present_status()
    {
        return $this->belongsTo(DsPresentStatus::class, 'present_status_id');
    }

    public function academic_qualification()
    {
        return $this->belongsTo(DsAcademicQualification::class, 'academic_qualification_id');
    }

    public function teaching_qualification()
    {
        return $this->belongsTo(DsTeachingQualification::class, 'teaching_qualification_id');
    }

    public function subject_of_qualification()
    {
        return $this->belongsTo(DsSubject::class, 'subject_of_qualification_id');
    }

    public function subject_taught()
    {
        return $this->belongsTo(DsSubject::class, 'main_subject_taught_id');
    }

    public function area_of_specialization()
    {
        return $this->belongsTo(DsSubject::class, 'area_of_specialization_id');
    }

    public function teaching_type()
    {
        return $this->belongsTo(DsTeachingType::class, 'teaching_type_id');
    }

    public function seminar_workshop()
    {
        return $this->belongsTo(DsSeminarWorkshop::class, 'seminar_workshop_id');
    }

    public function admissionStaffAttendances()
    {
        return $this->hasMany(StaffAttendance::class, 'admission_id', 'id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function rank()
    {
        return $this->belongsTo(DsRank::class);
    }

    public function gender()
    {
        return $this->belongsTo(DsGender::class);
    }

    public function staffAssignment()
    {
        return $this->hasMany(Staff::class, 'staff_id', 'id');
    }

    public function state_origin()
    {
        return $this->belongsTo(Atlas::class, 'state_of_origin_id', 'code_atlas_entity');
    }

    public function lga_origin()
    {
        return $this->belongsTo(Atlas::class, 'lga_of_origin_id', 'code_atlas_entity');
    }
}
