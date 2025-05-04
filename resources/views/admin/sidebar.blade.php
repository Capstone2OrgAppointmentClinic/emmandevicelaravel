<nav class="sidebar sidebar-offcanvas" id="sidebar" style="background-color: #AD1457;">
  <li class="nav-item menu-items  style=" margin-left: -1rem;"flex w-full justify-center items-center" style="list-style: none; margin: 10px -10px -40px -10px;">
    <a class="nav-link" href="{{url(path: 'home')}}">
      <img src="{{ asset('assets/img/person/svfctrans.png') }}" alt="" style="width:100px;  height:auto;">
    </a>
  </li>

  <ul class="nav" style="position: fixed;">
    <li class="nav-item profile" style="margin-bottom:40px; margin-left: 0%; height: 50px; flex-wrap: wrap;">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="profile-name" style="margin-left:-10px;">
            <span id="typewriter" style="white-space: pre; color: white; font-size: 24px; margin-bottom:10px;"></span>
          </div>
        </div>
        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown"></div>
      </div>
    </li>

        
        <ul class="nav" style="position: fixed;">
          <li class="nav-item profile mb-4" style="margin-top:-2.5rem; margin-left: -1rem;"></li>
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  
                </div>
                <div class="profile-name">
                </div>
              </div>
             
      
          
          <li class="nav-item menu-items" style=" margin-left: -1rem;" >
            <a class="nav-link" href="{{url(path: 'home')}}">
              <span class="menu-icon">
                <i class="mdi mdi-file-document-box" style="font-size: 18px;"></i>
              </span>
              <span class="menu-title" style="color:white; font-size:19px;">Dashboard</span>
            </a>
          </li>

    <li class="nav-item menu-items" style=" margin-left: -1rem;">
      <a class="nav-link" href="{{url(path: 'showappointment')}}">
        <span class="menu-icon">
          <i class="mdi mdi-file-document-box" style="font-size: 18px;"></i>
        </span>
        <span class="menu-title" style="color:white; font-size:19px;">Appointments</span>
      </a>
    </li>

    <li class="nav-item menu-items" style=" margin-left: -1rem;">
      <a class="nav-link" href="{{url('showdoctor')}}">
        <span class="menu-icon">
          <i class="mdi mdi-account-box-multiple" style="font-size: 18px;"></i>
        </span>
        <span class="menu-title" style="color:white; font-size:19px;">Doctors</span>
      </a>
    </li>

    <li class="nav-item menu-items" style=" margin-left: -1rem;">
      <a class="nav-link" href="{{url('calendar')}}">
        <span class="menu-icon">
          <i class="mdi mdi-calendar-month-outline" style="font-size: 18px;"></i>
        </span>
        <span class="menu-title" style="color:white; font-size:19px;">Calendar</span>
      </a>
    </li>

    <li class="nav-item menu-items" style=" margin-left: -1rem;">
      <a class="nav-link" href="{{ url('announcements') }}">
        <span class="menu-icon">
          <i class="mdi mdi-message-text-outline" style="font-size: 18px;"></i>
        </span>
        <span class="menu-title" style="color:white; font-size:19px;">Announcement</span>
      </a>
    </li>

    <li class="nav-item menu-items" style=" margin-left: -1rem;">
      <a class="nav-link" href="{{ url('studentlogs') }}">
        <span class="menu-icon">
          <i class="mdi mdi-message-text-outline" style="font-size: 18px;"></i>
        </span>
        <span class="menu-title" style="color:white; font-size:19px;">Logs</span>
      </a>
    </li>

    <li class="nav-item menu-items" style=" margin-left: -1rem;">
    <a class="nav-link" href="{{ url('medicine') }}">
    <span class="menu-icon">
          <i class="mdi mdi-message-text-outline" style="font-size: 18px;"></i>
        </span>
        <span class="menu-title" style="color:white; font-size:19px;">Medicine</span>
      </a>
    </li>

  </ul>
</nav>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const name = @json(Auth::user()->name);

    // Get the current hour
    const currentHour = new Date().getHours();
    
    let greeting;
    if (currentHour < 12) {
      greeting = "Good Morning";
    } else if (currentHour < 18) {
      greeting = "Good Afternoon";
    } else {
      greeting = "Good Evening";
    }

    // Split the name into two parts if it exceeds 20 characters
    const nameMaxLength = 20;
    let formattedName = name.length > nameMaxLength ? 
      `${name.slice(0, nameMaxLength)}<br>${name.slice(nameMaxLength)}` : name;

    // Combine greeting and formatted name
    const fullText = `${greeting}, <br>${formattedName}`;
    
    const target = document.getElementById("typewriter");
    target.style.fontSize = "20px";
    let i = 0;
    let isDeleting = false;

    function typeEffect() {
      if (isDeleting) {
        i--;
        target.innerHTML = fullText.substring(0, i);
      } else {
        i++;
        target.innerHTML = fullText.substring(0, i);
      }

      let speed = isDeleting ? 50 : 100;

      if (!isDeleting && i === fullText.length) {
        speed = 1000; // pause at end
        isDeleting = true;
      } else if (isDeleting && i === 0) {
        speed = 500;
        isDeleting = false;
      }

      setTimeout(typeEffect, speed);
    }

    typeEffect();
  });
</script>

<style>
  /* Styling the typewriter text */
  #typewriter {
    display: inline-block;
    color: white;
    font-size: 24px;
    white-space: normal; /* allow normal wrapping */
    word-break: break-word; /* break long words if needed */
    overflow-wrap: break-word; /* more reliable wrapping */
    max-width: 100%;
    line-height: 1.2;
  }

  /* Ensures the blinking cursor is visible and works correctly */
  #typewriter::after {
    content: "|";
    animation: blink 1s step-start infinite;
    color: white;
  }

  @keyframes blink {
    50% {
      opacity: 0;
    }
  }

  /* Prevent sidebar items from being affected */
  .nav {
    position: relative;
    padding-left: 10px;
  }
  .profile-name {
  margin-left: -10px;
  min-height: 3.5em; /* optional */
  display: flex;
  flex-direction: column;
  justify-content: center;
  text-align: center;
}

</style>