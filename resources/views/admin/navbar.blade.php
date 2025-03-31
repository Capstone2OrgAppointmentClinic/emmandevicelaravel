<div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row" style="background-color: #AD1457;">
          
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown d-none d-lg-block">
                <a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown" data-bs-toggle="dropdown" aria-expanded="false" href="#">In development</a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="createbuttonDropdown">
                  <h6 class="p-3 mb-0">Projects</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-file-outline text-primary"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">In development</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-web text-info"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">In development</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-layers text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">In development</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">In development</p>
                </div>
              </li>
              <li class="nav-item nav-settings d-none d-lg-block">
                <a class="nav-link" href="#">
                  <i class="mdi mdi-view-grid"></i>
                </a>
              </li>
              <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-email"></i>
                  <span class="count bg-success"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                  <h6 class="p-3 mb-0">Messages</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <!-- <img src="admin/assets/images/faces/face4.jpg" alt="image" class="rounded-circle profile-pic"> -->
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">In development</p>
                      <p class="text-muted mb-0"> In development </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <!-- <img src="admin/assets/images/faces/face2.jpg" alt="image" class="rounded-circle profile-pic"> -->
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">In testing</p>
                      <p class="text-muted mb-0"> In development </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <!-- <img src="admin/assets/images/faces/face3.jpg" alt="image" class="rounded-circle profile-pic"> -->
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">In testing</p>
                      <p class="text-muted mb-0"> In development </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">In testing</p>
                </div>
              </li>
              <li class="nav-item dropdown">
    <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="mdi mdi-bell" style="font-size: 20px;"></i>
    <span class="count bg-danger" style="font-size: 12px; padding: 5px 5px;">
            {{ auth()->user()->unreadNotifications->count() }}
        </span>
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




              
              <x-app-layout>
   
              </x-app-layout>

            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>