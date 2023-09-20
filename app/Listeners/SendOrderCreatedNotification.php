<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\Admin;
use App\Models\Vendor;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendOrderCreatedNotification
{

    public function __construct()
    {
        //
    }


    public function handle(OrderCreated $event) : void
    {
//        $order = $event->order;
//        $vendors = Vendor::where('store_id', $order->store_id)->get();
//        $admins = Admin::get();
//
//        Notification::send($admins, new OrderCreatedNotification($order));
//        Notification::send($vendors, new OrderCreatedNotification($order));
    }
}
