<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Page extends Model {
  public static function getuserData($class_id=0){

    if($class_id==0){
      $value=DB::table('student_admissions')->orderBy('class_id', 'asc')->get(); 
    }else{
      $value=DB::table('student_admissions')->where('class_id', $class_id)->first();
    }
    return $value;
  
  }
}