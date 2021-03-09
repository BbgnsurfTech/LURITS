<?php

namespace App;

use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use SoftDeletes, Notifiable, HasApiTokens, HasMediaTrait;

    public $table = 'users';

    protected $appends = [
        'profile_img',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'email_verified_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'last_name',
        'created_at',
        'updated_at',
        'deleted_at',
        'middle_name',
        'remember_token',
        'email_verified_at',
    ];

    public function getIsSuperAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 2)->exists();
    }

    public function getIsZeqaAttribute()
    {
        return $this->roles()->where('id', 3)->exists();
    }

    public function getIsLgeaAttribute()
    {
        return $this->roles()->where('id', 4)->exists();
    }

    public function getIsHeadTeacherAttribute()
    {
        return $this->roles()->where('id', 5)->exists();
    }

    public function getIsTeacherAttribute()
    {
        return $this->roles()->where('id', 6)->exists();
    }

    public function getIsParentAttribute()
    {
        return $this->roles()->where('id', 7)->exists();
    }

    public function getIsStudentAttribute()
    {
        return $this->roles()->where('id', 8)->exists();
    }

    public function schools()
    {
        return $this->belongsToMany(School::class);
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function assignedToTasks()
    {
        return $this->hasMany(Task::class, 'assigned_to_id', 'id');
    }

    public function assignedToAssets()
    {
        return $this->hasMany(Asset::class, 'assigned_to_id', 'id');
    }

    public function assignedUserAssetsHistories()
    {
        return $this->hasMany(AssetsHistory::class, 'assigned_user_id', 'id');
    }

    public function getProfileImgAttribute()
    {
        $file = $this->getMedia('profile_img')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function atlas()
    {
        return $this->belongsTo(AtlasUser::class, 'id', 'user_id');
    }
}
