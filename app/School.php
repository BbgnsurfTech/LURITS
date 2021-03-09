<?php

namespace App;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'schools';

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
        'school_id',
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

    // public function sharedFacility()
    // {
    //     return $this->belongsTo(SchoolSharedFacility::class, 'school_id', 'id');
    // }

    public function background()
    {
        return $this->hasOne(SchoolBackground::class, 'school_id', 'id');
    }

    public function lga()
    {
        return $this->hasOne(SchoolAtlas::class);
    }

    public function sector()
    {
        return $this->hasOne(DsSector::class, 'id', 'code_type_sector');
    }

    public function schoolUsers()
    {
        return $this->hasMany(User::class, 'school_id', 'id');
    }

    public function schoolSchools()
    {
        return $this->hasMany(School::class, 'school_id', 'id');
    }

    public function schoolEnrolledStudentAdmissions()
    {
        return $this->hasMany(StudentAdmission::class, 'school_enrolled_id', 'id');
    }

    public function schoolAttendances()
    {
        return $this->hasMany(Attendance::class, 'school_id', 'id');
    }

    public function schoolTeachers()
    {
        return $this->hasMany(Teacher::class, 'school_id', 'id');
    }

    public function schoolstudentAdmissions()
    {
        return $this->hasMany(StudentAdmission::class, 'school_id', 'id');
    }

    public function clazz()
    {
        return $this->hasMany(DsClass::class, 'school_id', 'id');
    }

    public function schoolTaskStatuses()
    {
        return $this->hasMany(TaskStatus::class, 'school_id', 'id');
    }

    public function schoolTasks()
    {
        return $this->hasMany(Task::class, 'school_id', 'id');
    }

    public function schoolAssetLocations()
    {
        return $this->hasMany(AssetLocation::class, 'school_id', 'id');
    }

    public function schoolAssets()
    {
        return $this->hasMany(Asset::class, 'school_id', 'id');
    }

    public function schoolAssetsHistories()
    {
        return $this->hasMany(AssetsHistory::class, 'school_id', 'id');
    }

    public function schoolContactCompanies()
    {
        return $this->hasMany(ContactCompany::class, 'school_id', 'id');
    }

    public function schoolContactContacts()
    {
        return $this->hasMany(ContactContact::class, 'school_id', 'id');
    }

    public function schoolExpenses()
    {
        return $this->hasMany(Expense::class, 'school_id', 'id');
    }

    public function schoolIncomes()
    {
        return $this->hasMany(Income::class, 'school_id', 'id');
    }

    public function schoolParents()
    {
        return $this->belongsToMany(Parents::class);
    }

    public function atlas()
    {
        return $this->hasOne(SchoolAtlas::class, 'school_id', 'id');
    }
}
