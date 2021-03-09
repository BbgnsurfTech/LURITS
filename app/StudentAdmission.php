<?php

namespace App;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Carbon\Carbon;

class StudentAdmission extends Model implements HasMedia
{
    use SoftDeletes,  HasMediaTrait, Auditable;

    public $table = 'student_admissions';

    const GENDER_SELECT = [
        '1' => 'Male',
        '2' => 'Female',
    ];

    const RELIGION_SELECT = [
        '1' => 'Islam',
        '2' => 'Christianity',
        '3' => 'Others',
    ];

    protected $appends = [
        'student_picture',
        'student_document',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const NATIONALITY_1_SELECT = [
        '1' => 'Nigeria',
        '2' => 'Niger',
    ];

    const STATE_ORIGIN_SELECT = [
        '121' => 'Katsina',
        '101' => 'Adamawa',
    ];

    protected $fillable = [
        'hubby',
        'gender_id',
        'address',
        'religion',
        'school_id',
        'last_name',
        'admission',
        'child_name',
        'created_at',
        'updated_at',
        'deleted_at',
        'middle_name',
        'state_origin',
        'date_of_birth',
        'nationality_1',
        'school_enrolled_id',
        'parent_guardian_id',
        'class_id',
        'blood_group_id',
        'marital_status_id',
        'disability_id',
        'state_of_origin_id',
        'lga_of_origin_id',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function admissionAttendances()
    {
        return $this->hasMany(Attendance::class, 'admission_id', 'id');
    }

    public function getStudentPictureAttribute()
    {
        $file = $this->getMedia('student_picture')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;
    }

    public function getStudentDocumentAttribute()
    {
        return $this->getMedia('student_document');
    }

    public function gender()
    {
        return $this->belongsTo(DsGender::class, 'gender_id');
    }

    public function bloodgroup()
    {
        return $this->belongsTo(DsBloodGroup::class, 'blood_group_id', 'id');
    }

    public function maritalstatus()
    {
        return $this->belongsTo(DsMaritalStatus::class, 'marital_status_id', 'id');
    }

    public function disability()
    {
        return $this->belongsTo(DsDisability::class, 'disability_id', 'id');
    }

    public function religion()
    {
        return $this->belongsTo(DsReligion::class, 'gender_id');
    }

    public function state()
    {
        return $this->belongsTo(Atlas::class, 'state_of_origin_id');
    }

    public function school_enrolled()
    {
        return $this->belongsTo(School::class, 'school_enrolled_id');
    }

    public function state_origin()
    {
        return $this->belongsTo(Atlas::class, 'state_of_origin_id', 'code_atlas_entity');
    }

    public function lga_origin()
    {
        return $this->belongsTo(Atlas::class, 'lga_of_origin_id', 'code_atlas_entity');
    }

    public function parent_guardian()
    {
        return $this->belongsTo(Parents::class, 'parent_guardian_id');
    }

    public function classs()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }
}
