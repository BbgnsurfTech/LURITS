<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZoneLGA extends Model
{
    protected $table = 'zones_lgas';
    protected $fillable = ['zone_id'];

    public function zone()
    {
        return $this->belongsTo('App\Models\Zone');
    }

}
