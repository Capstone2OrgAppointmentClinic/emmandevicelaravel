<nav class="sidebar sidebar-offcanvas" id="sidebar" style="background-color: #AD1457 ;">

        
        <ul class="nav" style="position: fixed;">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal" style="color:white;">Admin</h5>
                </div>
              </div>
              <a href="#" id="profile-dropdown" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical" style="color:white;"></i></a>
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-settings text-primary"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-onepassword  text-info"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-calendar-today text-success"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                  </div>
                </a>
              </div>
            </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link" style="color:white;">Navigation</span>
          </li>
          
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
      