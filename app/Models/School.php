<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{

    protected $table = 'schools';

    protected $fillable = ['name', 'ward_id', 'school_type_id', 'school_category_id'];

    public function ward(){
        return $this->belongsTo('App\Models\Ward');
    }

    public function school_category(){
        return $this->belongsTo('App\Models\SchoolCategory');
    }

    public function school_type(){
        return $this->belongsTo('App\Models\School_Type');
    }

    public function ClassRoom(){
        return $this->hasMany('App\Models\ClassRoom');
    }

    public function Staff(){
        return $this->hasMany('App\Models\Staff\Staff');
    }

    public function incidence(){
        return $this->hasMany('App\Models\Incidence');
    }
}
