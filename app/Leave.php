<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leave extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'leave';

    const STATUS_SELECT = [
        '1' => 'Approved',
        '2' => 'Not Approved',
    ];

    const LEAVE_TYPE = [
        '1' => 'Annual Leave',
        '2' => 'Casual Leave',
        '3' => 'Maternity Leave',
        '4' => 'Other Leave',
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
        'status',
        'rank',
        'contact_number',
        'address',
        'number_of_days',
        'leave_type',
        'start_date',
        'end_date',
        'remark',        
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }        
}