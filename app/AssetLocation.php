<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetLocation extends Model
{
    use SoftDeletes;

    public $table = 'asset_locations';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function locationAssets()
    {
        return $this->hasMany(Asset::class, 'location_id', 'id');
    }

    public function locationAssetsHistories()
    {
        return $this->hasMany(AssetsHistory::class, 'location_id', 'id');
    }
}
