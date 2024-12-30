<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

     protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'birth_date',
        'otp',
        'otp_expires_at',
    ];

    protected $hidden = [
        'password',
        'otp',
    ];

    protected $casts = [
        'otp_expires_at' => 'datetime',
    ];
}
