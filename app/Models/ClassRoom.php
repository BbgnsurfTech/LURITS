<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    protected $table = 'classes';
    protected $fillable = ['name'];

    public function class_setting(){
        return $this->hasMany('App\Models\ClassSetting');
    }

}
