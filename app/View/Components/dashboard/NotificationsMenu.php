<?php

namespace App\View\Components\dashboard;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Illuminate\View\View;

class NotificationsMenu extends Component
{
    public $notifications;
    public $newCount;

    public function __construct($count=10)
    {
        $user = Auth::user();
        $unreadNotifications = $user->notifications()
            ->whereNull('read_at')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $readNotifications = $user->notifications()
            ->whereNotNull('read_at')
            ->orderBy('created_at', 'desc')
            ->take(10 - $unreadNotifications->count()) // Get the remaining notifications to reach 10
            ->get();

        $this->notifications = $unreadNotifications->concat($readNotifications);
//        $this->notifications = $user->notifications()
//            ->take($count)
//            ->get();
        $this->newCount = $user->unreadNotifications()->count();
    }

    public function render() : View
    {
        return view('components.dashboard.notifications-menu');
    }
}
