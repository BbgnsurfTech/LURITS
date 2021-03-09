<?php

namespace App;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaffMovementRecord extends Model
{
    use SoftDeletes,  Auditable;

    public $table = 'staff_movement_record';

    const HT_APPROVAL = [
        '1' => 'Approved',
        '2' => 'Not Approved',
    ];

    const RANK_SELECT = [
        '1' => 'Rank',
        '2' => 'Another Rank',
        '3' => 'Another Another Rank'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'staff_id',
        'date',
        'rank',
        'contact_number',
        'purpose',
        'time_out',
        'time_back',
        'ht_approval',  
        'rank'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }        
}