<?php

namespace App;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes, MultiTenantModelTrait;

    public $table = 'teams';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'team_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function teamUsers()
    {
        return $this->hasMany(User::class, 'team_id', 'id');
    }

    public function teamTeams()
    {
        return $this->hasMany(Team::class, 'team_id', 'id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
