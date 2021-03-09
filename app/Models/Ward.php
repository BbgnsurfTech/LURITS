<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $table = 'wards';

    protected $fillable = ['name', 'lga_id'];

    public function lga(){
    	return $this->belongsTo('App\Models\LGA');
    }

    public function school(){
        return $this->hasMany('App\Models\School');
    }
}
