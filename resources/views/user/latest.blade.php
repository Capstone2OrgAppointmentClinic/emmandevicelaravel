<div class="page-section" style="background-color: antiquewhite;">
<<<<<<< HEAD
    <div class="container">
      <h1 class="text-center wow fadeInUp" style="font-size: 35px; color: #006400; font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-size:">Announcements</h1>
      <div class="row mt-5">
        <div class="col-lg-4 py-2 wow zoomIn">
          <div class="card-blog">
            <div class="header">
              <div class="post-category">
                <a href="#">Announcements</a>
              </div>
              <a href="blog-details.html" class="post-thumb">
                <img src="../assets/img/latestimg/chedsvfc.png" alt="">
              </a>
            </div>
            <div class="body">
              <h5 class="post-title"><a href="blog-details.html">St. Vincent De Ferrer College of Camarin (SVDFCC). The phaseout order was issued by CHEd in 2021 after the SVDFCC was found to have deficiencies in its academic performance and achievement. </a></h5> <!-- This use a variable in admin pages etc that can input and it shows in annoucements -->
              <div class="site-info">
                <div class="avatar mr-2">
                  <div class="avatar-img">
                    <img src="../assets/img/person/ched.png" alt="">
                  </div>
                  <span>CHED</span> <!--Use also variable or in admin panel to identify who published -->
                </div>
                <span class="mai-time"></span> 1 week ago
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 py-2 wow zoomIn">
          <div class="card-blog">
            <div class="header">
              <div class="post-category">
                <a href="#">Foundation Day</a>
              </div>
              <a href="blog-details.html" class="post-thumb">
                <img src="../assets/img/person/culturalmonth.png" alt="">
              </a>
            </div>
            <div class="body">
              <h5 class="post-title"><a href="blog-details.html">November 22, 2024: Foundation at SVFC are started will fulfillment, enjoyment, and learnings together with all faculties!</a></h5>
              <div class="site-info">
                <div class="avatar mr-2">
                  <div class="avatar-img">
                    <img src="../assets/img/person/svfctrans.png" alt="">
                  </div>
                  <span>SVFC MIS</span>
                </div>
                <span class="mai-time"></span> 3 Months ago
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 py-2 wow zoomIn">
          <div class="card-blog">
            <div class="header">
              <div class="post-category">
                <a href="#">Enrollments</a>
              </div>
              <a href="blog-details.html" class="post-thumb">
                <img src="../assets/img/latestimg/enrollmentsvfc.png" alt="">
              </a>
            </div>
            <div class="body">
              <h5 class="post-title"><a href="blog-details.html">St. Vincent de Ferrer College of Camarin Inc. Enrollment S.Y 24-25 is now ongoing. Enroll now and reserve your seat!</a></h5>
              <div class="site-info">
                <div class="avatar mr-2">
                  <div class="avatar-img">
                  <img src="../assets/img/person/svfctrans.png" alt="">
                  </div>
                  <span>SVFC MIS</span>
                </div>
                <span class="mai-time"></span> 3 weeks ago
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 text-center mt-4 wow zoomIn">
          <a href="{{url('announcement')}}" class="btn btn-primary" style="background-color:#f204f2;">More...</a>
        </div>

      </div>
    </div>
  </div> <!-- .page-section -->
=======
<style>
  .card-img-container {
    position: relative;
    width: 100%;
    height: 200px;
    overflow: hidden;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    cursor: pointer;
  }

  .card-img-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top;
    transition: transform 0.3s ease;
  }

  .card-img-container:hover img {
    transform: scale(1.05);
  }

  .type-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background-color: #007bff;
    color: #fff;
    padding: 5px 10px;
    font-size: 0.8rem;
    border-radius: 20px;
    z-index: 10;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
  }
.toggle-message {
    color: black ! important;
    text-decoration: none !important;
    transition: color 0.3s ease;
    
}
.hover-message:hover {
    color: #006400;
    cursor: pointer;
}
.announcement-slide {
  transition: opacity 0.3s ease;
}
.card {
  border-radius: 12px;
  margin-bottom: 20px;
  
}
</style>

<div class="container py-5">
  <h2 class="text-center mb-4">Announcements</h2>


  @php
$chunks = $announcements->chunk(3);
@endphp

<div id="announcementCarousel" class="position-relative">
  @foreach($chunks as $index => $chunk)
    <div class="row announcement-slide {{ $index === 0 ? '' : 'd-none' }}">
      @foreach($chunk as $announcement)
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <div class="card-img-container">
              <span class="type-badge">{{ $announcement->type }}</span>
              <img src="{{ asset($announcement->image ?? 'images/default-image.jpg') }}" class="card-img-top" alt="Announcement Image">
            </div>
            <div class="card-body d-flex flex-column">
              @php $isLong = strlen($announcement->message) > 200; @endphp

              @if($isLong)
                <a href="javascript:void(0);" class="toggle-message d-block mb-2">
                  <span class="short-message d-block">{{ \Illuminate\Support\Str::limit($announcement->message, 200, '...') }}</span>
                  <span class="full-message d-none">{{ $announcement->message }}</span>
                  <span class="toggle-text text-primary">more</span>
                </a>
              @else
                <p class="mb-2">{{ $announcement->message }}</p>
              @endif

              <div class="mt-auto">
                <small class="text-muted d-block">📌 {{ $announcement->title }}</small>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endforeach

  <div class="text-center mt-3">
    <button id="prevBtn" class="btn btn-outline-primary me-2">‹ Prev</button>
    <button id="nextBtn" class="btn btn-outline-primary">Next ›</button>
  </div>
</div>
<div class="col-12 text-center mt-4 wow zoomIn">
    <a href="{{url('announcement')}}" class="btn btn-primary" style="background-color: #f204f2;">More...</a>
</div>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const slides = document.querySelectorAll('.announcement-slide');
    let currentSlide = 0;

    function showSlide(index) {
      slides.forEach((slide, i) => {
        slide.classList.toggle('d-none', i !== index);
      });
    }

    function nextSlide() {
      currentSlide = (currentSlide + 1) % slides.length;
      showSlide(currentSlide);
    }

    function prevSlide() {
      currentSlide = (currentSlide - 1 + slides.length) % slides.length;
      showSlide(currentSlide);
    }

    document.getElementById('nextBtn').addEventListener('click', function () {
      nextSlide();
      resetAutoSlide();
    });

    document.getElementById('prevBtn').addEventListener('click', function () {
      prevSlide();
      resetAutoSlide();
    });

    let autoSlideInterval = setInterval(nextSlide, 5000);

    function resetAutoSlide() {
      clearInterval(autoSlideInterval);
      autoSlideInterval = setInterval(nextSlide, 5000);
    }

    showSlide(currentSlide);

    document.querySelectorAll('.toggle-message').forEach(function (el) {
      el.addEventListener('click', function () {
        const shortMsg = el.querySelector('.short-message');
        const fullMsg = el.querySelector('.full-message');
        const toggleText = el.querySelector('.toggle-text');

        const isExpanded = fullMsg.classList.contains('d-block');

        fullMsg.classList.toggle('d-none', isExpanded);
        fullMsg.classList.toggle('d-block', !isExpanded);
        shortMsg.classList.toggle('d-none', !isExpanded);
        shortMsg.classList.toggle('d-block', isExpanded);
        toggleText.textContent = isExpanded ? 'more' : 'less';
      });
    });
  });
</script>


</div> <!-- .page-section -->
>>>>>>> ce459b4393ad907b4f5890ca5b6177e181cc4c00
  