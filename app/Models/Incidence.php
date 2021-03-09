<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incidence extends Model
{
     protected $fillable = ['title', 'description', 'school_id', 'rate', 'photo'];

     public function school(){
         return $this->belongsTo('App\School');
     }

}
