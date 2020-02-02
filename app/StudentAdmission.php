<?php

namespace App;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class StudentAdmission extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, HasMediaTrait, Auditable;

    public $table = 'student_admissions';

    const GENDER_SELECT = [
        '1' => 'Male',
        '2' => 'Female',
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
        'gender',
        'team_id',
        'last_name',
        'admission',
        'child_name',
        'created_at',
        'updated_at',
        'deleted_at',
        'middle_name',
        'state_origin',
        'nationality_1',
        'school_enrolled_id',
        'parent_guardian_id',
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

    public function school_enrolled()
    {
        return $this->belongsTo(Team::class, 'school_enrolled_id');
    }

    public function parent_guardian()
    {
        return $this->belongsTo(ParentGuardianregister::class, 'parent_guardian_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
