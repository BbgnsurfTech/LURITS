<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailBoxSetting extends Model
{
    protected $table = "mailbox_settings";

    protected $fillable = ["setting_key", "setting_value"];
}
