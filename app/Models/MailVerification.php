<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'user_id',
    ];
}
