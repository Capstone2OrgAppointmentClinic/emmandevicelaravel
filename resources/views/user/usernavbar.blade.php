<style>
.nav-menu {
  position: relative;
  display: flex;
  gap: 10px;
  align-items: center;
}

.nav-menu .nav-item {
  position: relative;
  z-index: 2;
}

.nav-menu .nav-link {
  display: inline-block;
  padding: 10px 20px;
  color: white;
  transition: color 0.3s ease;
  position: relative;
  z-index: 2;
}
.nav-menu::before {
  content: '';
  position: absolute;
  top: 0;
  left: var(--left, 0px);
  width: var(--width, 0px);
  height: 100%;
  background-color: #00D9A5;
  border-radius: 12px;
  z-index: 1;
  opacity: 0.85;
  transform: scaleX(0.8);
  transition:
    left 0.3s ease,
    width 0.3s ease,
    transform 0.3s ease,
    opacity 0.3s ease;
}
.nav-menu:hover::before {
  opacity: 1;
  transform: scaleX(1);
}

.nav-menu .nav-item.active .nav-link {
  font-weight: bold;
  color: gray;
}

</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const navMenu = document.querySelector('.nav-menu');
    const items = navMenu.querySelectorAll('.nav-item');
    const activeItem = navMenu.querySelector('.nav-item.active');

    function moveIndicator(target) {
        const rect = target.getBoundingClientRect();
        const parentRect = navMenu.getBoundingClientRect();
        navMenu.style.setProperty('--left', `${target.offsetLeft}px`);
        navMenu.style.setProperty('--width', `${target.offsetWidth}px`);
    }
    if (activeItem) {
        moveIndicator(activeItem);
    }

    items.forEach(item => {
        if (item.classList.contains('login') || item.classList.contains('register')) {
            return;
        }

        item.addEventListener('mouseenter', () => moveIndicator(item));
    });

    navMenu.addEventListener('mouseleave', () => {
        if (activeItem) moveIndicator(activeItem);
    });
});
</script>
<nav class="navbar navbar-expand-lg navbar-light shadow-sm bg-light">
        <div class="container">
            <img src="../assets/img/person/svfctrans.png" alt="logo" style="width:auto; height: 60px;" />
            <a class="navbar-brand" href="{{url('/')}}">
                <span class="text-primary"><span style="color: #f204f2;">Clini</span></span>-QuickAid
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport"
                aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="" id="navbarSupport">
            <ul class="navbar-nav ml-auto nav-menu">
                    <li class="nav-item active"><a class="nav-link" href="{{url('/')}}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('aboutUs') }}">About us</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('announcement')}}">Announcements</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="https://portal.svfc-edu.com/login">Portal</a></li>
                    @if(Route::has('login'))
                    @auth
                    
     <!-- Appointment -->
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="{{ url('myappointment') }}">Appointment</a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('user.usercalendar') }}">Calendar</a></li>
    </ul>
</li>

<!-- Notification -->
<li class="nav-item">
    <a class="nav-link count-indicator" id="notificationLink" href="#" aria-expanded="false" data-bs-toggle="modal" data-bs-target="#notificationModal">
        <i class="fas fa-bell" style="font-size: 16px;"></i>
        @if(auth()->user()->unreadNotifications->count() > 0)
            <span class="count " style="font-size: 10px; padding: 5px 5px;">
                {{ auth()->user()->unreadNotifications->count() }}
            </span>
        @endif
    </a>
</li>

<!-- Modal to display notifications -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 300px; overflow-y: auto;">
                @if(auth()->user()->unreadNotifications->count() > 0)
                    @foreach(auth()->user()->unreadNotifications as $notification)
                        <a class="dropdown-item preview-item" href="{{ route('markAsRead', $notification->id) }}">
                            <div class="preview-item-content">
                                <p class="preview-subject mb-1">
                                    {{ $notification->data['message'] }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                @else
                    <p class="p-3 text-center text-muted">No new notifications</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="{{ url('markAllAsRead') }}" onclick="markAllAsRead()" class="btn btn-primary">Mark all as read</a>
            </div>
        </div>
    </div>
</div>

<style>
    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0;
    }

    .nav-item.dropdown .dropdown-menu li:hover,
    .nav-item.dropdown .dropdown-menu a.dropdown-item:hover {
        background-color: transparent !important;
        color: #00d9a5 !important;
        transition: none !important;
        box-shadow: none !important;
    }
    .modal-body {
        max-height: 300px;
        overflow-y: auto;
    }

    #notificationLink:hover {
        cursor: pointer;
    }

</style>
<!-- Add Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
                    <x-app-layout>

                    </x-app-layout>
                    @else
                    <li class="nav-item login">
                        <a class="btn btn-primary ml-lg-3" href="{{route('login')}}"
                            style="background-color: #f204f2;">Login</a>
                    </li>
                    <li class="nav-item register">
                        <a class="btn btn-primary ml-lg-3" href="{{route('register')}}"
                            style="background-color: #f204f2;">Register</a>
                    </li>
                    @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>
<style>
.nav-item .btn.btn-primary {
    background-color: transparent !important;
    border: 2px solid #f204f2 !important;
    color: gray !important;
    font-weight: bold;
    padding: 10px 20px;
    text: none !important;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.nav-item .btn.btn-primary:hover {
    background-color: #f204f2 !important;
    color: gray !important;
}
</style>
