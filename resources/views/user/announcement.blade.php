<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>CliniQuickAid</title>

  <link rel="stylesheet" href="../assets/css/maicons.css">

  <link rel="stylesheet" href="../assets/css/bootstrap.css">

  <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">

  <link rel="stylesheet" href="../assets/vendor/animate/animate.css">

  <link rel="stylesheet" href="../assets/css/theme.css">
</head>
<body>
  <div class="back-to-top"></div>

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
              <a class="nav-link" href="about.html">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="doctors.html">Doctors</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('announcement')}}">Announcements</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact</a>
            </li>
            
            @if(Route::has('login'))

            @auth

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="{{url('myappointment')}}">
              Appointment
             </a>
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
              <a class="btn btn-primary ml-lg-3" href="{{route('login')}}" style="background-color: #f204f2;">Login</a>
            </li>

            
            
            <li class="nav-item">
              <a class="btn btn-primary ml-lg-3" href="{{route('register')}}" style="background-color: #f204f2;">Register</a>
            </li>

            @endauth      
            @endif
           </ul>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>




<script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../assets/vendor/wow/wow.min.js"></script>

<script src="../assets/js/theme.js"></script>
  

</body>
</html>