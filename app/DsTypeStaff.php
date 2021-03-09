<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DsTypeStaff extends Model
{
    public $table = 'ds_type_staff';

    protected $fillable = [
    	'title',
    ];
}
