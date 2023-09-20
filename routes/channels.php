<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Config;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/
//

//    Broadcast::channel('App.Models.{guard}.{id}', function ($user, $guard, $id) {
////        if ($guard == 'Admin') {
////            $userID = Auth ::guard('admins') -> id();
////        } elseif ($guard == 'Vendor') {
////            $userID = Auth ::guard('vendors') -> id();
////        } else {
////            return false;
////        }
//
//        return (int)$user->id === (int)$id;
//    }, ['guards' => ['vendors', 'admins']]);

Broadcast::channel('App.Models.Admin.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
}, ['guards' => ['admins']]);

Broadcast::channel('App.Models.Vendor.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
}, ['guards' => ['vendors']]);