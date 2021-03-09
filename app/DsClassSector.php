<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DsClassSector extends Model
{
    public $table = 'ds_class_sector';

    // public function dsClass()
    // {
    // 	return $this->belongsTo(Asset::class, 'category_id', 'id');
    // }

    public function dsClass()
    {
        return $this->hasMany(DsClass::class, 'id', 'class_id');
    }
}
