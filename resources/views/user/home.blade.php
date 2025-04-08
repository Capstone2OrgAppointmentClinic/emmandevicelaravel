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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body class="bg-light">

<header>

@include('user.usernavbar')
    
</header>

@if(session()->has('message'))
<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    {{ session()->get('message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(!auth()->check())
<!-- Main  -->
<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="page-hero bg-image overlay-dark" style="background-image: url('../assets/img/latestimg/building.png');">
                <div class="hero-section">
                    <div class="container text-center wow zoomIn">
                        <span class="display-4 btn-headcolor" style="color:#f204f2;">CliniQuickAid</span><br><br>
                        <span class="subhead">your health</span>
                        <h1 class="display-4" style="color: #00D9A5;">Deserves Quick Care</h1>
                        <a href="#page-section" class="btn outline-btn">Get Started</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="carousel-item">
            <div class="page-hero bg-image overlay-dark" style="background-image: url('../assets/img/latestimg/CLINIC 1.png');">
                <div class="hero-section">
                    <div class="container text-center wow zoomIn">
                        <span class="display-4 btn-headcolor" style="color:#f204f2;">CliniQuickAid</span><br><br>
                        <span class="subhead">your health</span>
                        <h1 class="display-4" style="color: #00D9A5;">Deserves Quick Care</h1>
                        <a href="#page-section" class="btn outline-btn">Get Started</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="carousel-item">
            <div class="page-hero bg-image overlay-dark" style="background-image: url('../assets/img/latestimg/CLINIC 2.png');">
                <div class="hero-section">
                    <div class="container text-center wow zoomIn">
                        <span class="display-4 btn-headcolor" style="color:#f204f2;">CliniQuickAid</span><br><br>
                        <span class="subhead">your health</span>
                        <h1 class="display-4" style="color: #00D9A5;">Deserves Quick Care</h1>
                        <a href="#page-section" class="btn outline-btn">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden"></span>
    </a>
    <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden"></span>
    </a>
</div>


<style>
.outline-btn {
    background-color: transparent;
    border: 2px solid #f204f2;
    color: white;
    padding: 10px 20px;
    border-radius: 25px;
    font-size: 16px;
    font-weight: bold;
    transition: 0.3s;
}

.outline-btn:hover {
    background-color: #f204f2;
    color: white;
}
</style>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endif


@if(auth()->check())
@include('user.main')
@endif


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

    @if(!auth()->check())
    <div id="page-section" class="page-section pb-0" style="background-color: antiquewhite;">
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
  @endif

@if(!auth()->check())
    @include('user.doctor')
@endif
@include('user.chat')

@include('user.latest')

@if(auth()->check())
    <div id="appointment-section">
        @include('user.appointment')
    </div>
@endif

@include('user.footer')

<!-- Bootstrap Bundle -->
<script src="../assets/js/jquery-3.5.1.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>
<script src="../assets/vendor/wow/wow.min.js"></script>
<script src="../assets/js/theme.js"></script>

<!-- JavaScript to Show Modal on Load -->
<script>
     document.addEventListener("DOMContentLoaded", function () {
        const images = [
            "../assets/img/latestimg/building.png",
            "../assets/img/latestimg/clinic 1.png",
            "../assets/img/latestimg/clinic 2.png"
        ];

        let currentIndex = 0;
        const heroSection = document.querySelector(".page-hero");

        function changeBackground() {
            currentIndex = (currentIndex + 1) % images.length;
            heroSection.style.backgroundImage = `url('${images[currentIndex]}')`;
        }

        setInterval(changeBackground, 5000);
    });
     document.addEventListener('DOMContentLoaded', function () {
        let alertDivs = document.querySelectorAll('.alert');
        
        alertDivs.forEach(function(alert) {
            setTimeout(function () {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(function () {
                    alert.style.display = 'none';
                }, 500);
            }, 5000);
        });
    });
</script>

</body>

</html>
