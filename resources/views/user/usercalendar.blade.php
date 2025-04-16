<!DOCTYPE html>
<html lang="en">
<head>
    
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="../assets/css/maicons.css">

   <link rel="stylesheet" href="../assets/css/bootstrap.css">

   <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">

   <link rel="stylesheet" href="../assets/vendor/animate/animate.css">

   <link rel="stylesheet" href="../assets/css/theme.css">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

   <link rel="icon" href="{{ asset('assets/img/adminimg/titlebar.ico') }}" alt="SVFC" type="image/icon">
<style>
   #calendar {
    max-width: 1300px;
    margin: 40px auto;
    }
</style>

</head>
<body>
<header>
    
    

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm bg-light">
      <div class="container">
      <img src="../assets/img/person/svfctrans.png" alt="logo " style="width:auto; height: 60px;"/>
        <a class="navbar-brand" href="home"><span class="text-primary"><span style="color:#f204f2;">Clini</span></span>-QuickAid</a>
        

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="" id="navbarSupport">
          <ul class="navbar-nav ml-auto nav-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{url('/')}}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('aboutUs') }}">About us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('announcement')}}">Announcements</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="https://portal.svfc-edu.com/login">Portal</a></li>
            @if(Route::has('login'))

            @auth

            

            <li class="nav-item dropdown">
            <a class="nav-link  dropdown-toggle active" style="background: none; color: #AD1457;" href="{{url('user.usercalendar')}}">Calendar</a>
            <ul class="dropdown-menu">
                <li>
                                <a class="dropdown-item" href="{{ route('my_appointment') }}">Appointment</a>
                           
                          </li>
                        </ul>
                    </li>
                    <style>
     .dropdown:hover .dropdown-menu {
         display: block;
         margin-top: 0;
     }
 
    .dropdown-menu li:hover,
    .dropdown-menu a.dropdown-item:hover {
     background-color: transparent !important;
     color: #00d9a5 !important;
     transition: none !important;
     box-shadow: none !important;
    }
     </style>
            

            <x-app-layout>
            </x-app-layout>

            @else
            
            
            <li class="nav-item">
              <a class="btn btn-primary ml-lg-3" href="{{route('login')}}">Login</a>
            </li>

            
            
            <li class="nav-item">
              <a class="btn btn-primary ml-lg-3" href="{{route('register')}}">Register</a>
            </li>

            @endauth

            
            @endif
         
        
        </ul>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>
  
  <div class="container">
    <div id="calendar"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            footerToolbar: {
                left: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: "{{ url('/user/get-appointments') }}", 
            editable: false,
            selectable: true,
            eventClick: function (info) {
                alert('Appointment: ' + info.event.title);
            },
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            }
        });

        calendar.render();
    });
</script>



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>


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


</body>
</html>
    