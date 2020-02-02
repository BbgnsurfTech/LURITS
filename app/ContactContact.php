<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactContact extends Model
{
    use SoftDeletes;

    public $table = 'contact_contacts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'created_at',
        'company_id',
        'updated_at',
        'deleted_at',
        'contact_email',
        'contact_skype',
        'contact_phone_1',
        'contact_phone_2',
        'contact_address',
        'contact_last_name',
        'contact_first_name',
    ];

    public function company()
    {
        return $this->belongsTo(ContactCompany::class, 'company_id');
    }
}
