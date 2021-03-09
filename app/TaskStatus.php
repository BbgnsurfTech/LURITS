<?php

namespace App;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskStatus extends Model
{
    use SoftDeletes, MultiTenantModelTrait;

    public $table = 'task_statuses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'school_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function statusTasks()
    {
        return $this->hasMany(Task::class, 'status_id', 'id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }
}
