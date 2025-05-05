<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="copyright" content="MACode ID, https://macodeid.com/" />

  <title>CliniQuickAid</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <link rel="icon" href=" {{ asset('assets/img/adminimg/titlebaricon.ico') }}" type="image/icon">

  <link rel="stylesheet" href="../assets/css/maicons.css" />
  <link rel="stylesheet" href="../assets/css/bootstrap.css" />
  <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css" />
  <link rel="stylesheet" href="../assets/vendor/animate/animate.css" />
  <link rel="stylesheet" href="../assets/css/theme.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>

@keyframes slideInRight {
  0% {
    opacity: 0;
    transform: translateX(50px);
  }
  100% {
    opacity: 1;
    transform: translateX(0);
  }
}


.slide-in-right {
  animation: slideInRight 1s ease-out forwards;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 20px;
}
.slide-in-right i {
  font-size: 130px;
  color: red;
}



    @keyframes slideInLeft {
  0% {
    opacity: 0;
    transform: translateX(-50px);
  }
  100% {
    opacity: 1;
    transform: translateX(0);
  }
}

.slide-in-left {
  animation: slideInLeft 1s ease-out forwards;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 20px;
}
.slide-in-left img {
  width: 200px; /* Adjust based on your preference */
  height: auto;
}

    

    
    html, body {
      height: 100%;
      margin: 0;
    }

    .page-wrapper {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .flex-grow-1 {
      flex: 1;
    }

    footer {
      background-color: #2c3e50;
      color: white;
      padding: 40px 20px;
    }
    .about-header {
      padding: 60px 15px;
      background: linear-gradient(135deg, rgba(242, 4, 242, 0.6), rgba(248, 158, 248, 0.6)),
                  url('../assets/img/facilities/CLINIC 2.png') no-repeat center center;
      background-size: cover;
      color: white;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      margin: 0 auto 30px auto;
      max-width: 100%;
    }
    .lg-toolbar,
    .lg-prev,
    .lg-next {
      display: none !important;
    }
    .about-header h1 {
      font-size: 40px;
      font-weight: bold;
      margin: 0;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    }
    .section-title h2 {
      font-size: 24px; 
      font-weight: 600;
      position: relative;
      display: inline-block;
      margin-bottom: 10px;
    }
    .section-title h2::after {
      display: block;
      width: 60%;
      height: 3px;
      margin: 5px auto 0;
      border-radius: 5px;
    }
    .gallery-img {
       height: 180px;
       object-fit: cover;
       width: 130%;
       transition: transform 0.3s ease, box-shadow 0.3s ease;
       cursor: pointer;
   }
    .gallery-img:hover {
      transform: scale(1.05);
      border: 3px solid #f204f2;
    }
    .modal {
      display: none;
      position: fixed;
      z-index: 1050;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.9);
      align-items: center;
      justify-content: center;
      flex-direction: column;
    }

    .modal-content {
      max-width: 80%;
      max-height: 80%;
      border-radius: 8px;
      box-shadow: 0 0 30px rgba(255, 255, 255, 0.2);
    }

    .close {
      position: absolute;
      top: 15px;
      right: 35px;
      color: #fff;
      font-size: 40px;
      font-weight: bold;
      cursor: pointer;
    }

    .close:hover {
      color: #f204f2;
    }

    .nav-btn {
      cursor: pointer;
      position: absolute;
      top: 50%;
      padding: 16px;
      color: white;
      font-size: 40px;
      font-weight: bold;
      border: none;
      background-color: transparent;
      user-select: none;
    }

    .left {
      left: 20px;
    }

    .right {
      right: 20px;
    }

    .nav-btn:hover {
      color: #f204f2;
    }
    .dropdown:hover .dropdown-menu {
      display: block;
      margin-top: 0;
    }

    .dropdown-menu li:hover,
    .dropdown-menu a.dropdown-item:hover {
      background-color: transparent !important;
      color: #ff00ff !important;
    }
  </style>
</head>

<body>
  <div class="page-wrapper">

    <div class="flex-grow-1">
      <header>
        <nav class="navbar navbar-expand-lg navbar-light shadow-sm bg-light">
          <div class="container">
            <img src="../assets/img/person/svfctrans.png" alt="logo" style="width:auto; height: 60px;" />
            <a class="navbar-brand" href="home">
              <span class="text-primary"><span style="color:#f204f2;">Clini</span></span>-QuickAid
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="" id="navbarSupport">
              <ul class="navbar-nav ml-auto nav-menu">
                <li class="nav-item"><a class="nav-link" href="{{url('/')}}">Home</a></li>
                <li class="nav-item active"><a class="nav-link" href="{{ url('aboutUs') }}">Who We Are </a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('announcement')}}">Announcements</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="https://portal.svfc-edu.com/login">Portal</a></li>

                @if(Route::has('login'))
                  @auth
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="{{url('myappointment')}}">Appointment</a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('user.usercalendar') }}">Calendar</a></li>
                      </ul>
                    </li>

                    <x-app-layout></x-app-layout>

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
            </div>
          </div>
        </nav>
      </header>

      <!-- Main Content -->
      <div class="about-header text-center">
        <h1 class="pb-4">About us</h1>
        <div style="font-size: 28px; max-width: 900px; margin-left: auto; margin-right: auto; text-align: justify; padding: 0;"><span>A streamlined clinic appointment system designed to make scheduling quick, easy, and accessible for all students and staff. </span>
      </div>
      </div>
      <h1 class="text-center mb-4 pt-4">MISSION</h1>
      <div class="slide-in-left" style="max-width: 900px; margin: 0 10%; padding-top: 2rem; ">
  <img src="{{ asset('assets/img/person/svfctrans.png') }}" alt="School Logo">
  <div style="font-size: 28px; text-align: justify;">
    <span>
      IT'S MISSION TO PROVIDE ITS PATIENTS WITHIN THE COLLEGE, THE HIGHEST QUALITY PATIENT
      CARE SERVICES AND ADVOCACY WHICH IS RESPONSIVE TO COMMUNITY DEMANDS THROUGH THE
      PROGRAMS AND ACTIVITIES OF THE WELLNESS CLINIC.
    </span>
  </div>
</div>
<DIV style="margin-top: 32px;">
<h1 class="text-center mb-4 pt-4">VISION</h1>
<div class="slide-in-right" style="max-width: 900px; margin: 0 10%; padding-top: 2rem; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
  <div style="font-size: 28px; text-align: justify;">
    <span>
      IT ENVISIONS TO BE A PROVIDER OF RESPONSIVE AND EXCELLENT HEALTH, DENTAL, AND NURSING
      SERVICES AND ADVOCACY TO THE COMMUNITY OF ST. VINCENT DE FERRER COLLEGE OF CAMARIN.
    </span>
  </div>
  
  <i class="bi bi-bullseye"></i>
</div>
</DIV>


      <div class="container pb-5 mt-5" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">
        <div class="section-title text-center">
          <h2 class="w-full text-center mb-4 pt-4" style="font-size:33px;"> CLINIC FACILITIES</h2>
        </div>
        <div class="row gallery">
          <div class="col-md-4 mb-4"><img src="../assets/img/facilities/CLINIC 1.png" class="img-fluid rounded shadow-lg gallery-img" alt=""></div>
          <div class="col-md-4 mb-4"><img src="../assets/img/facilities/CLINIC 2.png" class="img-fluid rounded shadow-lg gallery-img" alt=""></div>
          <div class="col-md-4 mb-4"><img src="../assets/img/facilities/CLINIC 3.png" class="img-fluid rounded shadow-lg gallery-img" alt=""></div>
          <div class="col-md-4 mb-4"><img src="../assets/img/facilities/CLINIC 4.png" class="img-fluid rounded shadow-lg gallery-img" alt=""></div>
          <div class="col-md-4 mb-4"><img src="../assets/img/facilities/CLINIC 6.png" class="img-fluid rounded shadow-lg gallery-img" alt=""></div>
          <div class="col-md-4 mb-4"><img src="../assets/img/facilities/CLINIC 7.png" class="img-fluid rounded shadow-lg gallery-img" alt=""></div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal" id="imageModal">
        <button class="close" id="closeModal">&times;</button>
        <img id="modalImage" class="modal-content" src="" alt="Preview Image">
        <button id="prevBtn" class="nav-btn left">&#10094;</button>
        <button id="nextBtn" class="nav-btn right">&#10095;</button>
      </div>
    </div>

    @include('user.footer')

  </div> 

  <!-- Scripts -->
  <script src="../assets/js/jquery-3.5.1.min.js"></script>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>
  <script src="../assets/vendor/wow/wow.min.js"></script>
  <script src="../assets/js/theme.js"></script>

  <script>
    const galleryImages = document.querySelectorAll('.gallery-img');
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const closeModal = document.getElementById('closeModal');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    let currentIndex = 0;

    const showModal = (index) => {
      currentIndex = index;
      modalImage.src = galleryImages[currentIndex].src;
      modal.style.display = 'flex';
    };

    galleryImages.forEach((img, index) => {
      img.addEventListener('click', () => showModal(index));
    });

    closeModal.addEventListener('click', () => {
      modal.style.display = 'none';
    });

    nextBtn.addEventListener('click', () => {
      currentIndex = (currentIndex + 1) % galleryImages.length;
      modalImage.src = galleryImages[currentIndex].src;
    });

    prevBtn.addEventListener('click', () => {
      currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
      modalImage.src = galleryImages[currentIndex].src;
    });

    modal.addEventListener('click', (e) => {
      if (e.target === modal) modal.style.display = 'none';
    });
  </script>

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

</body>
</html>