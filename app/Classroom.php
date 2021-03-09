<?php

namespace App;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Classroom extends Model implements HasMedia
{
    use SoftDeletes,  HasMediaTrait, Auditable;

    public $table = 'classroom';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'capacity',
        'year',
        'condition',
        'length',
        'width',
        'floor_material',
        'wall_material',
        'roof_material',
        'seating',
        'school_id',
        'writing_board',
    ];

    public function classCondition()
    {
        return $this->belongsTo(DsClassroomCondition::class, 'condition');
    }

    public function floorMaterial()
    {
        return $this->belongsTo(DsClassroomFloorMaterial::class, 'floor_material');
    }

    public function wallMaterial()
    {
        return $this->belongsTo(DsClassroomWallMaterial::class, 'wall_material');
    }

    public function roofMaterial()
    {
        return $this->belongsTo(DsClassroomRoofMaterial::class, 'roof_material');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function availableSeating()
    {
        return $this->belongsTo(DsYesNo::class, 'seating', 'id');
    }

    public function writingBoard()
    {
        return $this->belongsTo(DsYesNo::class, 'writing_board');
    }
}


