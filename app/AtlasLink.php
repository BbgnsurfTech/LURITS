<?php

namespace App;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AtlasLink extends Model
{

    public $table = 'atlas_link';

     protected $fillable = [
        'code_atlas_entity',
        'code_atlas_link',
            
     ];
    // public function atlas()
    // {
    //     return $this->belongsTo(Atlas::class, 'code_atlas_entity');
    // }
}