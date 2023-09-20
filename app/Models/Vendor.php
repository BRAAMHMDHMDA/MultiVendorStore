<?php

namespace App\Models;

use App\Traits\GetImageUrl;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Notifications\Notifiable;

class Vendor extends Authenticatable
{
    use Notifiable , HasImage, GetImageUrl;

    public static string $imageDisk = 'media';
    public static string $imageFolder = '/vendors';

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'phone_number',
        'image_path',
        'status',
        'store_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
