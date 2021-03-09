<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DsSubjectSector extends Model
{
    public $table = 'ds_subject_sector';

    protected $fillable = ['subject_id', 'sector_id'];

    public function subjectName()
    {
    	return $this->belongsTo(DsSubject::class, 'subject_id');
    }
}
