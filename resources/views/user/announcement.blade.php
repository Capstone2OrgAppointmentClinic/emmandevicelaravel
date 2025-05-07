<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="{{ asset('assets/img/adminimg/titlebaricon.ico ') }}" type="image/icon">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>CliniQuickAid</title>

  
  <link rel="stylesheet" href="../assets/css/maicons.css">

  <link rel="stylesheet" href="../assets/css/bootstrap.css">

  <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">

  <link rel="stylesheet" href="../assets/vendor/animate/animate.css">

  <link rel="stylesheet" href="../assets/css/theme.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


<style>
  .card-horizontal {
    display: flex;
    flex-direction: row;
    height: 100%;
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    position: relative;
  }

  .card-img-wrapper {
    position: relative;
    width: 30%;
    height: 100%;
  }

  .card-img-left {
    width: 30%;
    height: 100%;
    object-fit: cover;
    object-position: top;
    border-top-left-radius: 8px;
    border-bottom-left-radius: 8px;
    transition: transform 0.3s ease;
  }
  .card-img-left:hover {
    transform: scale(1.05);
    cursor: pointer;
  }

  .type-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background-color: #007bff;
    color: #fff;
    padding: 5px 10px;
    font-size: 0.75rem;
    border-radius: 20px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    z-index: 2;
  }

  .card-body-right {
    width: 70%;
    padding: 15px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    text-align: left;
  }

  .card-body-right .short-message,
  .card-body-right .full-message {
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .toggle-message {
    color: black !important;
    text-decoration: none !important;
    transition: color 0.3s ease;
  }

  .hover-message:hover {
    color: #006400;
    cursor: pointer;
  }
</style>



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
          <ul class="navbar-nav ml-auto nav-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{url('/')}}">Home</a>
            </li>
            <li class="nav-item">

              <a class="nav-link" href="{{ url('aboutUs') }}">Who We Are</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="{{url('announcement')}}">Announcements</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/Home/Contact') }}">Contact</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="https://portal.svfc-edu.com/login">Portal</a>
            </li>

            
            @if(Route::has('login'))

            @auth

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle " style="background: none; color: #00d9a5;" href="{{url('myappointment')}}">
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
     color: #00d9a5 !important;
     transition: none !important;
     box-shadow: none !important;
    }
     </style>

            <x-app-layout>
            </x-app-layout>

            @else
            
            
            <li class="nav-item login">
              <a class="btn btn-primary ml-lg-3" href="{{route('login')}}" style="background-color: #f204f2;">Login</a>
            </li>

            
            
            <li class="nav-item register">
              <a class="btn btn-primary ml-lg-3" href="{{route('register')}}" style="background-color: #f204f2;">Register</a>
            </li>

            @endauth      
            @endif
           </ul>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>

  <div class="container py-5">
  <h2 class="text-center mb-4" style="font-size: 30px;">Announcements</h2>

  <i class=""></i>
  <div class="row">
    @foreach($announcements as $announcement)
      <div class="col-md-12 mb-3">
        <div class="card card-horizontal">

          {{-- Image on the left --}}
          @if($announcement->image)
            <img src="{{ asset($announcement->image) }}" class="card-img-left" alt="Announcement Image">
          @else
            <img src="{{ asset('images/default-image.jpg') }}" class="card-img-left" alt="Default Image">
          @endif

          {{-- Message on the right --}}
          <div class="card-body-right">
            <span class="type-badge">{{ $announcement->type }}</span>

            {{-- Full message directly --}}
            <p class="mb-2">{{ $announcement->message }}</p>

            <div class="mt-auto">
              <small class="text-muted d-block">📌 {{ $announcement->title }}</small>
            </div>
          </div>

        </div>
      </div>
    @endforeach
  </div>
</div>
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


@include('user.footer')

<script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../assets/vendor/wow/wow.min.js"></script>

<script src="../assets/js/theme.js"></script>

</body>
</html>