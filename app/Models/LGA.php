<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LGA extends Model
{
    protected $table = 'lgas';
    protected $fillable = ['name', 'state_id', 'zone_id'];

    public function zone()
    {
        return $this->belongsTo('App\Models\Zone');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }

    public function ward()
    {
        return $this->hasMany('App\Models\Ward');
    }


}
