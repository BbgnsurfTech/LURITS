<?php

namespace App;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolAtlas extends Model
{

    public $table = 'school_atlas_entity';

     protected $fillable = [
        'school_id',
        'code_atlas_entity',
            
     ];

    public function atlas()
    {
        return $this->belongsTo(Atlas::class, 'code_atlas_entity', 'code_atlas_entity');
    }
}