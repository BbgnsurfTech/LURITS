<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School_Type extends Model
{
    protected $table = "school_types";
    protected $fillable = ['name'];

    public function school(){
        return $this->hasMany('App\Models\School');
    }
}
