<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Intl\Countries;

class OrderAddress extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'order_id', 'type', 'first_name', 'last_name', 'address_alias_name', 'email', 'phone_number',
        'street_address', 'city', 'postal_code', 'state', 'country',
    ];

    public function getNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getCountryNameAttribute(): string
    {
        return Countries::getName($this->country);
    }
}
