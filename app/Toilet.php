<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Toilet extends Model
{
    use SoftDeletes, Auditable;
    
    public $table = 'toilets';

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

     public function toiletCondition()
    {
        return $this->belongsTo(DsClassroomCondition::class, 'ds_condition_id');
    }

    public function toiletUser()
    {
        return $this->belongsTo(DsUserToilet::class, 'ds_user_toilet_id');
    }

    public function toiletType()
    {
        return $this->belongsTo(DsToilet::class, 'ds_toilet_id');
    }

    public function toiletUsage()
    {
        return $this->belongsTo(DsToiletUsage::class, 'ds_toilet_usage_id');
    }
}
