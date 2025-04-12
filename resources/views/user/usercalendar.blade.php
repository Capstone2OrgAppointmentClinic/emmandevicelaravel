<!DOCTYPE html>
<html lang="en">
<head>

    
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="../assets/css/maicons.css">

   <link rel="stylesheet" href="../assets/css/bootstrap.css">

   <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">

   <link rel="stylesheet" href="../assets/vendor/animate/animate.css">

   <link rel="stylesheet" href="../assets/css/theme.css">

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
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
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
            <a class="nav-link dropdown-toggle active" style="background: none; color:#00d9a5;" href="{{ route('user.usercalendar') }}">Calendar</a>
                        <ul class="dropdown-menu">
                            <li>
                            <a class="dropdown-item" href="{{url('myappointment')}}">Appointment</a>
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
</body>
</html>
    