<?php

namespace App;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParentGuardianregister extends Model
{
    use SoftDeletes, MultiTenantModelTrait;

    public $table = 'parent_guardianregisters';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'email',
        'last_name',
        'first_name',
        'created_at',
        'updated_at',
        'deleted_at',
        'middle_name',
        'phone_number',
    ];

    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }
}
