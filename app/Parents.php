<?php

namespace App;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Parents extends Model
{
    use SoftDeletes;

    public $table = 'parents';

    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'email', 'password','gender', 'date_of_birth', 'phone_number', 'address', 'profession', 'photo', 'income', 'school_id',
    ];

    // protected $appends = [
    //     'photos',
    // ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // protected $hidden = [
    //     'password', 'remember_token',
    // ];


    public function incomeStatus()
    {
    	return $this->belongsTo(DsEconomicStatus::class, 'income');
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function gender()
    {
        return $this->belongsTo(DsGender::class);
    }
}