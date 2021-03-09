<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolCategory extends Model
{
    protected $table = "school_categories";
    protected $fillable = ['name'];

    public function school(){
        return $this->hasMany('App\Models\School');
    }
}
