<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Auditable;

class Atlas extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'atlas_entity';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'code_atlas_entity',
        'name_atlas_entity',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // public function atlasLink()
    // {
    //     return $this->hasMany(AtlasLink::class, 'code_atlas_link', 'code_atlas_entity');
    // }
    
    public function schools()
    {
        return $this->hasMany(School::class, 'school_atlas_entity', 'school_id', 'code_atlas_entity');
    }
}
