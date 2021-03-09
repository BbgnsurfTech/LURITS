<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolSubject extends Model
{
	public $table = 'school_subjects';
	
    protected $fillable = ['subject_id', 'class_id', 'school_id'];

    public function subjectName()
    {
    	return $this->belongsTo(DsSubject::class, 'subject_id');
    }

    public function className()
    {
    	return $this->belongsTo(SchoolClass::class, 'class_id');
    }
}
