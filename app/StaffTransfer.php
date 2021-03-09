<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffTransfer extends Model
{
	protected $fillable = [
		'current_school',
		'target_school'
	];

    public function staff()
    {
    	return $this->belongsTo(Staff::class);
    }

    public function currentSchool()
    {
    	return $this->belongsTo(School::class, 'current_school');
    }

    public function targetSchool()
    {
    	return $this->belongsTo(School::class, 'target_school');
    }
}
