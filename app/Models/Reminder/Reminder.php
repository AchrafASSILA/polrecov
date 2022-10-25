<?php

namespace App\Models\Reminder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;
    protected $fillable = ['send_to', 'isSendToMail', 'isSendToWhats', 'dateSend', 'dateOfLivred', 'fileName', 'message', 'file_to_send', 'email_to', 'cc', 'object', 'user'];
}
