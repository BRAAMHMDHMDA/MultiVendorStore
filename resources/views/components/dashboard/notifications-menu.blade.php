<!-- Notification -->
<li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1" id="notification-menu-container">
    <a
            class="nav-link dropdown-toggle hide-arrow"
            href="javascript:void(0);"
            data-bs-toggle="dropdown"
            data-bs-auto-close="outside"
            aria-expanded="false">
        <i class="ti ti-bell ti-md"></i>
        @if ($newCount)
            <span class="badge bg-danger rounded-pill badge-notifications" id="notifications-count">{{ $newCount }}</span>
        @endif
    </a>
    <ul class="dropdown-menu dropdown-menu-end py-0">
        <li class="dropdown-menu-header border-bottom">
            <div class="dropdown-header d-flex align-items-center py-3">
                <h5 class="text-body mb-0 me-auto">Notification</h5>
                <a
                        href="{{route('dashboard.notifications.markAsRead')}}"
                        class="dropdown-notifications-all text-body"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Mark all as read"
                ><i class="ti ti-mail-opened fs-4"></i
                    ></a>
            </div>
        </li>
        <li class="dropdown-notifications-list scrollable-container">
            <ul class="list-group list-group-flush" id="ul-notifications">
                @foreach($notifications as $notification)
                        <li class="notification-item list-group-item list-group-item-action dropdown-notifications-item
                            @if ($notification->unread()) text-bold @else marked-as-read @endif"
                            onclick="window.location.href= '{{ url('dashboard/orders/'.$notification->data['order_id'].'?notification_id='.$notification->id) }}' "
                            >
                                  <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <span class="avatar-initial rounded-circle bg-label-success">
                                                <i class="{{ $notification->data['icon'] }}"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        @if($notification->type ==="App\Notifications\OrderCreatedNotification")
                                            <h6 class="mb-1">New Order 🎉</h6>
                                        @endif
                                        <p class="mb-0">{{ $notification->data['body'] }}</p>
                                        <small class="text-muted">{{ $notification->created_at->longAbsoluteDiffForHumans() }}</small>
                                    </div>
                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                        <a href="javascript:void(0)" class="dropdown-notifications-read">
                                            <span class="badge badge-dot"></span>
                                        </a>
                                        <a href="javascript:void(0)" class="dropdown-notifications-archive">
                                            <span class="ti ti-x"></span>
                                        </a>
                                    </div>
                                </div>
                         </li>
                @endforeach

            </ul>
        </li>
        <li class="dropdown-menu-footer border-top">
            <a
                    href="javascript:void(0);"
                    class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center">
                View all notifications
            </a>
        </li>
    </ul>
</li>
<!--/ Notification -->

<script>
    // document.addEventListener('DOMContentLoaded', function () {
    //     var notificationItems = document.querySelectorAll('.notification-item');
    //
    //     notificationItems.forEach(function (notificationItem) {
    //         notificationItem.addEventListener('click', function () {
    //             var url = this.getAttribute('data-url');
    //             window.location.href = url;
    //         });
    //     });
    // });


    // $(function () {
    //     $('#notification-item').click(function () {
    //         const url = $(this).data('url');
    //         window.location.href = url;
    //     });
    // });
    // // Get the notification item element by its ID or another selector
    // const notificationItem = document.getElementById('notification-item');
    //
    // // Add a click event listener to the notification item
    // notificationItem.addEventListener('click', function() {
    //     // Get the URL from the data-url attribute
    //     const url = this.getAttribute('data-url');
    //
    //     // Redirect to the URL
    //     window.location.href = url;
    // });
</script>