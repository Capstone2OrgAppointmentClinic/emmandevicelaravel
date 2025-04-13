<div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row" style="background-color: #AD1457;">
          
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch" >
            <button class="navbar-toggler navbar-toggler align-self-center mt-2" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu text-white text-[44px]" ></span>
            </button>
            <nav class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-settings d-none d-lg-block">
                <a class="nav-link" href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer">
                <img src="{{ asset('assets/img/blog/facebook.png') }}" alt="Facebook" style="height: 24px;">
            </a>
            </li>
            <li class="nav-item nav-settings d-none d-lg-block">
                <a class="nav-link" href="https://www.youtube.com/" target="_blank" rel="noopener noreferrer">
                <img src="{{ asset('assets/img/blog/youtube.png') }}" alt="Youtube" style="height: 24px;">
                </a>
            </li>
            <li class="nav-item nav-settings d-none d-lg-block">
                <a class="nav-link" href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox" target="_blank" rel="noopener noreferrer">
                <img src="{{ asset('assets/img/blog/gmail.png') }}" alt="Gmail" style="height: 24px;">
                </a>
            </li>
            <li class="nav-item dropdown">
  <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="mdi mdi-bell" style="font-size: 22px;"></i>
    @if(auth()->user()->unreadNotifications->count() > 0)
        <span class="count bg-danger" style="font-size: 12px; padding: 5px 5px;">
            {{ auth()->user()->unreadNotifications->count() }}
        </span>
    @endif
</a>

    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
        <h6 class="p-3 mb-0">Notifications</h6>
        <div class="dropdown-divider"></div>

        <div style="max-height: 300px; overflow-y: auto;">
            @if(auth()->user()->unreadNotifications->count() > 0)
                @foreach(auth()->user()->unreadNotifications as $notification)
                    <a class="dropdown-item preview-item" href="{{ route('markAsRead', $notification->id) }}">
                        <div class="preview-item-content">
                        <p class="preview-subject mb-1">
          @if(isset($notification->data['status']) && $notification->data['status'] == 'Rescheduled')
                <strong>Appointment Rescheduled by {{ $notification->data['name'] ?? 'Unknown' }}</strong>
          @else
               New Appointment from <strong>{{ $notification->data['name'] ?? 'Unknown' }}</strong>
          @endif
           </p>
             <p class="text-muted mb-0">
                 Service: {{ $notification->data['service'] ?? 'No Service' }} |
                 Date: {{ $notification->data['date'] ?? 'No Date' }} |
                 Time: {{ $notification->data['time'] ?? 'No Time' }}
             </p>

              @if(isset($notification->data['status']) && $notification->data['status'] == 'Rescheduled')
              <p class="text-warning mb-0">Reason: {{ $notification->data['reason'] ?? 'No Reason Provided' }}</p>
              @endif
                        </div>
                    </a>
                @endforeach
            @else
                <p class="p-3 text-center text-muted">No new notifications</p>
            @endif
        </div>

        <div class="dropdown-divider"></div>
        <h6 class="p-3 mb-0 text-center">
            <a href="#" onclick="markAllAsRead()">Mark all as read</a>
        </h6>
    </div>
</li>

<script>
    function markAllAsRead() {
        fetch('/mark-all-as-read')
            .then(response => {
                if (response.ok) {
                    location.reload();
                }
            });
    }
</script>     
             <!-- Modal Trigger Button -->
            <li class="nav-item nav-settings d-none d-lg-block">
                <button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#logsModal">
                    <i class="mdi mdi-history" style="font-size: 24px; color: white;" title="View Logs History"></i>
                </button>
            </li>
              <x-app-layout>
   
              </x-app-layout>

            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>