<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactCompany extends Model
{
    use SoftDeletes;

    public $table = 'contact_companies';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'created_at',
        'updated_at',
        'deleted_at',
        'company_name',
        'company_email',
        'company_address',
        'company_website',
    ];

    public function companyContactContacts()
    {
        return $this->hasMany(ContactContact::class, 'company_id', 'id');
    }
}
