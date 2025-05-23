<?php

namespace App\Models;

use App\Traits\GetImageUrl;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable, HasImage, GetImageUrl;
    public static string $imageDisk = 'media';
    public static string $imageFolder = '/admins';
    protected $fillable = [
        'name',
        'email',
        'username',
        'phone_number',
        'image_path',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
