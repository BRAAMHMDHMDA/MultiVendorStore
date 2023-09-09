<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    public const STATUS_NEW = 'new';
    public const STATUS_READ = 'read';

    protected $fillable = ['name', 'email', 'mobile', 'user_id', 'subject', 'message', 'status'];
    protected $with =['user'];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest',
        ]);
    }

}
