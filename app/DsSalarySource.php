<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DsSalarySource extends Model
{
    public $table = 'ds_salary_source';

    protected $fillable = [
    	'title',
    ];
}
