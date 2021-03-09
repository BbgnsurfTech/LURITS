<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LGA;

class Zone extends Model
{
    protected $fillable = ['name', 'state_id'];

    public function lgas(){
    	return $this->hasMany('App\Models\LGA');
    }    
    
    public function zones_lgas(){
    	return $this->hasMany('App\Models\ZoneLGA');
    }
}
