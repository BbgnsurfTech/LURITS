<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    public $table = 'students_flow';

    protected $fillable = [
        'admission_id',
    	'flow_id',
        'current_class_id',
        'target_class_id',
    	'term',
    	'session_id'
    ];

    public function student()
    {
    	return $this->belongsTo(StudentAdmission::class, 'admission_id');
    }

    public function flow()
    {
        return $this->belongsTo(DsFlow::class);
    }

    public function currentClass()
    {
        return $this->belongsTo(SchoolClass::class, 'current_class_id');
    }

    public function targetClass()
    {
        return $this->belongsTo(SchoolClass::class, 'target_class_id');
    }

    public function term()
    {
    	return $this->belongsTo(DsTerm::class, 'term', 'id');
    }

    public function session()
    {
    	return $this->belongsTo(DsSession::class);
    }
}
