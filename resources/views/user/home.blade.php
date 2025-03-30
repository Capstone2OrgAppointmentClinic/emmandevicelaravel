<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <link rel="icon" type="image/png" href="../assets/css/svfc.png" />
  <title>SVFC CliniQuickAid Appointment System</title>

  <link rel="stylesheet" href="../assets/css/maicons.css">
  <link rel="stylesheet" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">
  <link rel="stylesheet" href="../assets/vendor/animate/animate.css">
  <link rel="stylesheet" href="../assets/css/theme.css">

  <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
  <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
  <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-light">

@include('user.announce')
<header>

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm bg-light">
        <div class="container">
            <img src="../assets/img/person/svfctrans.png" alt="logo" style="width:auto; height: 60px;" />
            <a class="navbar-brand" href="{{url('/')}}">
                <span class="text-primary"><span style="color:#f204f2;">Clini</span></span>-QuickAid
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport"
                aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="" id="navbarSupport">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a class="nav-link" href="{{url('/')}}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal"
                            data-bs-target="#maintenanceModal">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal"
                            data-bs-target="#maintenanceModal">Doctors</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('announcement')}}">Announcements</a></li>
                    <li class="nav-item"><a class="nav-link" href="https://portal.svfc-edu.com/login">Portal</a></li>

                    @if(Route::has('login'))
                    @auth
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{url('myappointment')}}">Appointment</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('user.usercalendar') }}">Calendar</a></li>
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
     color: #ff00ff !important;
     transition: none !important;
     box-shadow: none !important;
    }
     </style>
                    <x-app-layout>

                    </x-app-layout>
                    @else
                    <li class="nav-item">
                        <a class="btn btn-primary ml-lg-3" href="{{route('login')}}"
                            style="background-color: #f204f2;">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary ml-lg-3" href="{{route('register')}}"
                            style="background-color: #f204f2;">Register</a>
                    </li>
                    @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>

@if(session()->has('message'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert"></button>
    {{session()->get('message')}}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{session('error')}}
</div>
@endif

<!-- Main Hero Section -->
<div class="page-hero bg-image overlay-dark" style="background-image: url(../assets/img/latestimg/building.png);">
    <div class="hero-section">
        <div class="container text-center wow zoomIn">
            <span class="display-4 btn-headcolor" style="color:#f204f2;">CliniQuickAid</span><br><br>
            <span class="subhead">your health</span>
            <h1 class="display-4" style="color: #00D9A5;">Deserves Quick Care</h1>
            <a href="#appointment-section" class="btn btn-primary" style="background-color:#f204f2;">Make Your
                Appointment Now!</a>
        </div>
    </div>
</div>


<div class="bg-light">
    <div class="page-section py-3 mt-md-n5 custom-index items-center ml-5">
      <div class="container">
        <div class="row justify-content-center ">
          <div class="col-md-4 py-3 py-md-0">
            <div class="card-service wow fadeInUp">
              <div class="circle-shape bg-secondary text-white">
                <span class="mai-chatbubbles-outline"></span>
              </div>
              <p><span>Chat</span> with Assistant Bot</p>
            </div>
          </div>
          <div class="col-md-4 py-3 py-md-0">
            <div class="card-service wow fadeInUp">
              <div class="circle-shape bg-primary text-white">
                <span class="mai-shield-checkmark"></span>
              </div>
              <p><span>Health<br></span> Check-ups</p>
            </div>
          </div>
          <div class="col-md-4 py-3 py-md-0">
            <div class="card-service wow fadeInUp">
              <div class="circle-shape bg-accent text-white">
                <span class="mai-calendar"></span>
              </div>
              <p><span>Appointment</span>-Scheduling</p>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- .page-section -->

    <div class="page-section pb-0" style="background-color: antiquewhite;">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 py-3 wow fadeInUp">
            <h1 style="font-size: 40px; ">Welcome to the <br>Clini-QuickAid Appointment</h1>
            <p class="text-grey mb-4 mt-5"> <b>Prioritize your health with ease! CliniQuickAid allows students in SVFC to conveniently schedule their school  </b> clinic visits for check-ups, consultations, and medical assistance, no more long wait times. Stay healthy and get the care you need, when you need it. Book your appointment now!`</p>
            <a href="about.html" class="btn btn-primary" style="background-color:#f204f2 ;">Details...</a>
          </div>
          <div class="col-lg-6 wow fadeInRight" data-wow-delay="400ms">
            <div class="img-place custom-img-1">
              <img src="../assets/img/doctors/docluna.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </div> <!-- .bg-light -->
  </div> <!-- .bg-light -->

@include('user.doctor')
@include('user.latest')
@include('user.chat')
<div id="appointment-section">
    @include('user.appointment')
</div>

<footer class="page-footer">
    <div class="container">
        <div class="row px-md-3">
            <div class="col-sm-6 col-lg-3 py-3">
                <h5>School Information</h5>
                <ul class="footer-menu">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contacts</a></li>
                    <li><a href="#">Management Information System</a></li>
                    <li><a href="#">CHED</a></li>
                </ul>
            </div>
            <div class="col-sm-6 col-lg-3 py-3">
                <h5>School Social Media's</h5>
                <ul class="footer-menu">
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">Viber</a></li>
                </ul>
            </div>
            <div class="col-sm-6 col-lg-3 py-3">
                <h5>School Activities</h5>
                <ul class="footer-menu">
                    <li><a href="#">Fieldtrips</a></li>
                    <li><a href="#">Foundation Day</a></li>
                    <li><a href="#">Monthly Activities</a></li>
                </ul>
            </div>
            <div class="col-sm-6 col-lg-3 py-3">
                <h5>Project created by:</h5>
                <a href="https://www.facebook.com/emrayzap.04" class="footer-link" target="_blank">Aligan, Rhed</a>
                <a href="https://www.facebook.com/emrayzap.04" class="footer-link" target="_blank">Coniaro, Joanna Mae</a>
                <a href="https://www.facebook.com/emrayzap.04" class="footer-link" target="_blank">Buenafe, Danilo Jr</a>
                <a href="https://www.facebook.com/emrayzap.04" class="footer-link" target="_blank">Lumba, Bryan Justine</a>
                <a href="https://www.facebook.com/emrayzap.04" class="footer-link" target="_blank">Coronel, Cristina</a>
                <a href="https://www.facebook.com/emrayzap.04" class="footer-link" target="_blank">Paz, Emmanuel Ray</a>
            </div>
        </div>
        <hr>
        <p id="copyright">All rights reserved © 2025</p>
    </div>
</footer>

<!-- Bootstrap Bundle -->
<script src="../assets/js/jquery-3.5.1.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>
<script src="../assets/vendor/wow/wow.min.js"></script>
<script src="../assets/js/theme.js"></script>

<!-- JavaScript to Show Modal on Load -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var myModalEl = document.getElementById('announcementModal');
        if (myModalEl) {
            var myModal = new bootstrap.Modal(myModalEl);
            myModal.show();
        }
document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                myModal.hide();
            });
        });
    });
</script>

</body>

</html>
