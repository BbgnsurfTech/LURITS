<?php

namespace App;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;

class AssetsHistory extends Model
{
    public $table = 'assets_histories';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'asset_id',
        'status_id',
        'created_at',
        'updated_at',
        'assigned_user_id',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function status()
    {
        return $this->belongsTo(AssetStatus::class, 'status_id');
    }

    public function assigned_user()
    {
        return $this->belongsTo(Staff::class, 'assigned_user_id', 'id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }
}
