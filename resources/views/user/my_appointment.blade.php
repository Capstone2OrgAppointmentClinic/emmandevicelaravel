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

            <li class="nav-item">
             <a class="nav-link" href="{{url('myappointment')}}">My Appointment</a>
            </li>


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
  <div align="center" style="padding: 70px;">
    <h1 style="font-size: 40px; padding: 15px;  color: #000; font-weight: bold;">
        Appointment Schedule
    </h1>

        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped mt-4 shadow-lg" style="width: 100%; max-width: 1000px; border-radius: 12px; overflow: hidden;">
                <thead class="bg-success text-white">
                    <tr>
                        <th style="padding: 12px; font-size: 20px;">Service</th>
                        <th style="padding: 12px; font-size: 20px;">Date</th>
                        <th style="padding: 12px; font-size: 20px;">Time</th>
                        <th style="padding: 12px; font-size: 20px;">Message</th>
                        <th style="padding: 12px; font-size: 20px;">Status</th>
                        <th style="padding: 12px; font-size: 20px;">Cancel Appointment</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appoint as $appoints)
                    <tr class="align-middle">
                    <td style="padding: 12px; font-size: 18px; color: #333;">{{$appoints->service}}</td>
                    <td style="padding: 12px; font-size: 18px; color: #333;">{{$appoints->date}}</td>
                    <td style="padding: 12px; font-size: 18px; color: #333;">
                     {{ date('h:i A', strtotime($appoints->time)) }}
                    </td>
                        <td style="padding: 12px; font-size: 18px; color: #333;">{{$appoints->message}}</td>
                        <td style="padding: 12px; font-size: 18px;">
    @php
        $status = strtolower(trim($appoints->status));
    @endphp

    @if($status == 'in progress')
        <span class="badge bg-warning text-dark" style="font-size: 14px;">{{ ucfirst($appoints->status) }}</span>
    @elseif($status == 'approved')
        <span class="badge bg-success" style="font-size: 14px;">{{ ucfirst($appoints->status) }}</span>
    @elseif($status == 'canceled')
        <span class="badge bg-danger" style="font-size: 14px;">{{ ucfirst($appoints->status) }}</span>
    @else
        <span class="badge bg-secondary" style="font-size: 14px;">{{ ucfirst($appoints->status) }}</span>
    @endif
</td>


                        <td>
                            <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to cancel this?')" 
                                href="{{url('cancel_appoint', $appoints->id)}}" 
                                style="padding: 6px 12px; font-size: 14px;">
                                Cancel
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../assets/vendor/wow/wow.min.js"></script>

<script src="../assets/js/theme.js"></script>
  
</body>
@include('user.calendar')
</html>