<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="icon" href="{{ asset('assets/img/adminimg/titlebaricon.ico') }}" type=" image/icon">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>CliniQuickAid</title>

  
  <link rel="stylesheet" href="../assets/css/maicons.css">

  <link rel="stylesheet" href="../assets/css/bootstrap.css">

  <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">

  <link rel="stylesheet" href="../assets/vendor/animate/animate.css">

  <link rel="stylesheet" href="../assets/css/theme.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
            <li class="nav-item ">
              <a class="nav-link" href="{{url('announcement')}}">Announcements</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link " href="{{ url('/Home/Contact') }}">Contact</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="https://portal.svfc-edu.com/login">Portal</a>
            </li>

            
            @if(Route::has('login'))

            @auth

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle"  href="{{url('myappointment')}}">
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

<div class="row mt-5">
  <!-- Contact Information Section -->
  <div class="col-md-6">
  <h2 class="section-title mb-4" style="font-size: 28px; font-weight: 600;">Contact Information</h2>
  <ul class="list-unstyled contact-list" style="font-size: 18px; line-height: 1.8; padding-left: 10px;">
    <li><strong>Clinic Name:</strong> SVFC - CliniQuickAid Appointment System </li>
    <li><strong>Address:</strong> 
    Area D, SVFC Compound, San Vincente Ferrer St, Brgy 178 Camarin, Caloocan, 1400 Metro Manila</li>
    <li><strong>Phone:</strong> (02) 1234-5678</li>
    <li><strong>Email:</strong> clinic@svfc-edu.com</li>
    <li><strong>Facebook: </strong> St.VIncent de Ferrer College of Camarin Inc.</li>
    <li><strong>Operating Hours:</strong> Monday – Friday, 8:00 AM – 5:00 PM</li>
  </ul>
</div>


  <!-- Contact Form Section -->
  <div class="col-md-6">
  <h2 class="section-title mb-4">Got a Question or Concern? We’re Here to Help!</h2>




  
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form id="contactForm" action="{{ route('contact.store') }}" method="POST">
  @csrf

  <!-- Name Field -->
  <div class="form-group">
    <label for="contactName">Name</label>
    <input type="text" class="form-control" id="contactName" name="name" placeholder="Your Name">
    @error('name')
      <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>

  <!-- Email Field -->
  <div class="form-group">
    <label for="contactEmail">Email</label>
    <input type="email" class="form-control" id="contactEmail" name="email" placeholder="your@email.com">
    @error('email')
      <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>

  <!-- Message Field -->
  <div class="form-group">
    <label for="contactMessage">Message</label>
    <textarea class="form-control" id="contactMessage" name="message" rows="4" placeholder="Type your message here..."></textarea>
    @error('message')
      <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>

  <!-- Submit Button -->
  <button type="submit" class="btn btn-submit">Send</button>
</form>

<script>
  document.getElementById('contactForm').addEventListener('submit', function(event) {
    // Check if the user is authenticated
    @if (Auth::check())
      // Proceed with form submission if authenticated
    @else
      event.preventDefault(); // Prevent form submission
      alert('Oops! You must be logged in to send your message. Please log in to continue.');
      window.location.href = '{{ route('login') }}'; // Redirect to login page
    @endif
  });
</script>

</div>

</div>

<style>
  /* Styling for the Contact Section */
  .section-title {
    font-family: 'Poppins', sans-serif;
    color: #333;
    font-size: 30px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 2px;
  }

  .contact-list {
    font-family: 'Roboto', sans-serif;
    font-size: 16px;
    color: #555;
  }

  .contact-list li {
    margin-bottom: 12px;
    line-height: 1.8;
  }

  .contact-list li strong {
    color: #f204f2;
    font-weight: bold;
  }

  .form-group label {
    font-family: 'Roboto', sans-serif;
    color: #333;
    font-weight: 500;
  }

  .form-control {
    border-radius: 8px;
    padding: 12px;
    border: 1px solid #ddd;
    margin-bottom: 15px;
    font-size: 16px;
    font-family: 'Roboto', sans-serif;
  }

  .btn-submit {
    background-color: #f204f2;
    border-color: #f204f2;
    padding: 12px 25px;
    color: white;
    font-weight: bold;
    border-radius: 50px;
    text-transform: uppercase;
    transition: background-color 0.3s ease;
  }

  .btn-submit:hover {
    background-color: #d403d0;
    border-color: #d403d0;
    transition: background-color 0.3s ease;
  }

  /* Background and Padding */
  .col-md-6 {
    background-color: #f8f9fa;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  /* Adding Margin to the Entire Row */
  .row.mt-5 {
    margin-top: 60px;
  }

  /* Responsive Design */
  @media (max-width: 767px) {
    .col-md-6 {
      margin-bottom: 20px;
    }
  }
</style>


<!-- Map Row with Search Bar -->
<div class="row mt-5 m-4">
  <div class="col-12">
  <h2 class="mb-4 text-center w-full text-2xl font-semibold tracking-wide text-gray-800">📍 Our Location on the Map</h2>

    
    <!-- Google Maps Search Bar -->
    <div class="input-group mb-4 w-4/12">
      <input type="text" class="form-control" id="searchInput" placeholder="Search for a place..." aria-label="Search for a place">
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button" id="searchButton">Search</button>
      </div>
    </div>

    <div class="embed-responsive embed-responsive-16by9">
      <!-- Google Maps iframe with dynamic search -->
      <iframe 
        id="googleMapIframe"
        class="embed-responsive-item" 
        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDTYcCqiYYcK0RjciGgi4WbH9RCU4zt_40&q=St.%20Vincent%20de%20Ferrer%20College%20of%20Camarin%2C%20Inc." 
        allowfullscreen="" 
        loading="lazy">
      </iframe>
    </div>
  </div>
</div>

<script>
  // This script will change the iframe src based on search input.
  document.getElementById('searchButton').addEventListener('click', function() {
    const query = document.getElementById('searchInput').value;
    const iframe = document.getElementById('googleMapIframe');
    const apiKey = "AIzaSyDTYcCqiYYcK0RjciGgi4WbH9RCU4zt_40"; // Replace with your API key

    // Update iframe source with the new location search
    iframe.src = `https://www.google.com/maps/embed/v1/place?key=${apiKey}&q=${encodeURIComponent(query)}`;
  });
</script>


@include('user.footer')

<script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../assets/vendor/wow/wow.min.js"></script>

<script src="../assets/js/theme.js"></script>

</body>
</html>