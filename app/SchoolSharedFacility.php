<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolSharedFacility extends Model
{
    public $table = 'school_shared_facilities';

    public $timestamps = false;

    protected $fillable = [
        'school_id',
        'ds_facility_id'
    ];
}
