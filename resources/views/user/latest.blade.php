<div class="page-section" style="background-color: antiquewhite; min-height: 800px;">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

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
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
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

    .announcement-slide {
      transition: opacity 0.3s ease;
    }

    .card {
      border-radius: 12px;
      margin-bottom: 20px;
    }
  </style>

  <div class="container py-5">
    <h2 class="text-center mb-3">Announcements</h2>

    <!-- Check if there are any announcements -->
    @if($announcements->isEmpty())
      <!-- Heroicon for No Announcements -->
      <x-heroicon-o-inbox class="h-12 w-12 text-gray-500 mb-3" />
      <p>No Announcements Available</p>
    @else
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
      </div>

      <div class="text-center mt-3">
        <button id="prevBtn" class="btn btn-outline-primary me-2">‹ Prev</button>
        <button id="nextBtn" class="btn btn-outline-primary">Next ›</button>
      </div>
    @endif

    <div class="col-12 text-center mt-4 wow zoomIn">
      <a href="{{url('announcement')}}" class="btn btn-primary" style="background-color: #f204f2;">More...</a>
    </div>

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
</div>
</div> <!-- .page-section -->
