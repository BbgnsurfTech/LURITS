<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentAdmission extends Model
{
    use SoftDeletes;

    public $table = 'student_admissions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'child_name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
