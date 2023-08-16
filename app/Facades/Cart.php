<?php

namespace App\Facades;

use App\Repositories\Cart\CartInterfaceRepo;
use Illuminate\Support\Facades\Facade;

class Cart extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CartInterfaceRepo::class;
    }
}