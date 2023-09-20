import Echo from 'laravel-echo'
import Pusher from 'pusher-js'
import toastr from 'toastr/toastr'

toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: 'toast-top-right',
};

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

var channel = window.Echo.private(`App.Models.${guard}.${id}`);

channel.notification( function(data) {
    // console.log(data)
    // toastr.success('Success message goes here');
    UpdateNotificationMenu(data)

    let count = parseInt($('#notifications-count').text(), 10) + 1;
    $('#notifications-count').text(count)
});

function UpdateNotificationMenu(data) {
    // Create a new li element
    const newNotificationItem = $("<li>", {
        class: "notification-item list-group-item list-group-item-action dropdown-notifications-item new-notify", // You can add any classes you need
        "onclick": `window.location.href= "${data.url}?notification_id=${data.id}" ` , // Customize the data-url attribute
     });

    // Create the inner structure of the new notification item
        const innerContent = `
      <div class="d-flex">
        <div class="flex-shrink-0 me-3">
          <div class="avatar">
            <span class="avatar-initial rounded-circle bg-label-success">
              <i class="${data.icon}"></i>
            </span>
          </div>
        </div>
        <div class="flex-grow-1">
          <h6 class="mb-1">New Order 🎉</h6>
          <p class="mb-0">${data.body}</p>
          <small class="text-muted">Now</small>
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
    `;

    // Set the inner content of the new notification item
        newNotificationItem.html(innerContent);

    // Append the new notification item to the notification list
    $("#ul-notifications").prepend(newNotificationItem);

    // let newNotify = $('#new-notify');
    $('#new-notify').click(function () {
        window.location.href = this.getAttribute('data-url');
    });


}