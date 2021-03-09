<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DsClass extends Model
{
    public $table = 'ds_class';

    protected $fillable = [
    	'title',
    ];

    // public function armm()
    // {
    // 	return $this->belongsTo(DsArms::class, 'arm_id', 'id');
    // }
}
