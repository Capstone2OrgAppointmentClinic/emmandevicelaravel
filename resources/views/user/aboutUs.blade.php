<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="copyright" content="MACode ID, https://macodeid.com/" />

  <title>CliniQuickAid</title>

  <link rel="icon" href=" {{ asset('assets/img/adminimg/titlebaricon.ico') }}" type="image/icon">

  <link rel="stylesheet" href="../assets/css/maicons.css" />
  <link rel="stylesheet" href="../assets/css/bootstrap.css" />
  <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css" />
  <link rel="stylesheet" href="../assets/vendor/animate/animate.css" />
  <link rel="stylesheet" href="../assets/css/theme.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    
    

    
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
                <li class="nav-item active"><a class="nav-link" href="{{ url('aboutUs') }}">About us</a></li>
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
                    <li class="nav-item">
                      <a class="btn btn-primary ml-lg-3" href="{{route('login')}}" style="background-color: #f204f2;">Login</a>
                    </li>
                    <li class="nav-item">
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
        <h1>About us</h1>
      </div>

      <div class="container pb-5">
        <div class="section-title text-center">
          <h2>Clinic Facilities</h2>
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
