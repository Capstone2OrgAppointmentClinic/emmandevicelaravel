<nav class="sidebar sidebar-offcanvas" id="sidebar" style="background-color: #AD1457;">
<li class="nav-item menu-items" style=" list-style: none; margin: 20px -10px -40px -10px;">
            <a class="nav-link" href="{{url(path: 'home')}}" style="width: 100px;">

             <img src="{{ asset('assets/img/person/svfctrans.png') }}" alt="">
            </a>
          </li>

        
        <ul class="nav" style="position: fixed;">
          <li class="nav-item profile mb-4" style="margin-top:-2.5rem; margin-left: -1rem;">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal" style="color:white; font-size:24px;">Hello, </h5>
                </div>
              </div>
              
          <!-- <li class="nav-item nav-category">
            <span class="nav-link" style="color:white;">Navigation</span>
          </li> -->
          
          <li class="nav-item menu-items">
            <a class="nav-link" href="{{url(path: 'home')}}">
              <span class="menu-icon">
                <i class="mdi mdi-file-document-box" style="font-size: 18px;"></i>
              </span>
              <span class="menu-title" style="color:white; font-size:19px;">Dashboard</span>
            </a>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link" href="{{url(path: 'showappointment')}}">
              <span class="menu-icon">
                <i class="mdi mdi-file-document-box" style="font-size: 18px;"></i>
              </span>
              <span class="menu-title" style="color:white; font-size:19px;">Appointments</span>
            </a>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('showdoctor')}}">
              <span class="menu-icon">
                <i class="mdi mdi-account-box-multiple" style="font-size: 18px;"></i>
              </span>
              <span class="menu-title" style="color:white; font-size:19px;">Doctors</span>
            </a>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('calendar')}}">
              <span class="menu-icon">
                <i class="mdi mdi-calendar-month-outline" style="font-size: 18px;"></i>
              </span>
              <span class="menu-title" style="color:white; font-size:19px;">Calendar</span>
            </a>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('announcements') }}">
              <span class="menu-icon">
                <i class="mdi mdi-message-text-outline" style="font-size: 18px;"></i>
              </span>
              <span class="menu-title" style="color:white; font-size:19px;">Announcement</span>
            </a>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('studentlogs') }}">
              <span class="menu-icon">
                <i class="mdi mdi-message-text-outline" style="font-size: 18px;"></i>
              </span>
              <span class="menu-title" style="color:white; font-size:19px;">Logs/History</span>
            </a>
          </li>

        </ul>
        
      </nav>
      