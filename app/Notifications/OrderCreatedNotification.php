<?php

namespace App\Notifications;

use App\Models\Order;
use App\Models\OrderAddress;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    protected Order $order;
    protected OrderAddress $addr;
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->addr = $this->order->billingAddress;
    }


    public function via($notifiable)
    {
        return ['database', 'broadcast'];

//        $channels = ['database'];
//        if ($notifiable->notification_preferences['order_created']['mail'] ?? false) {
//            $channels[] = 'mail';
//        }
//        if ($notifiable->notification_preferences['order_created']['sms'] ?? false) {
//            $channels[] = 'vonage';
//        }
//        if ($notifiable->notification_preferences['order_created']['broadcast'] ?? false) {
//            $channels[] = 'broadcast';
//        }
//        return $channels;
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("New Order #{$this->order->number}")
            ->greeting("Hi {$notifiable->name},")
            ->line("A new order (#{$this->order->number}) created by {$this->addr->name} from {$this->addr->country_name}.")
            ->action('View Order', url('/dashboard/orders/'.$this->order->id))
            ->line('Thank you for using our application!');
    }
    public function toDatabase($notifiable)
    {
        return [
            'body' => "A new order (#{$this->order->number}) created by {$this->addr->name} from {$this->addr->country_name}.",
            'icon' => 'ti ti-shopping-cart',
            'url' => url('/dashboard/orders/'.$this->order->id),
            'order_id' => $this->order->id,
        ];
    }

    public function toBroadcast($notifiable)
    {
         return new BroadcastMessage([
            'body' => "A new order (#{$this->order->number}) created by {$this->addr->name} from {$this->addr->country_name}.",
            'icon' => 'ti ti-shopping-cart',
            'url' => url('/dashboard/orders/'.$this->order->id),
            'order_id' => $this->order->id,
        ]);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
