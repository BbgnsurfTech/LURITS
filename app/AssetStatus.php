<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetStatus extends Model
{
    use SoftDeletes;

    public $table = 'asset_statuses';

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

    public function statusAssets()
    {
        return $this->hasMany(Asset::class, 'status_id', 'id');
    }

    public function statusAssetsHistories()
    {
        return $this->hasMany(AssetsHistory::class, 'status_id', 'id');
    }
}
