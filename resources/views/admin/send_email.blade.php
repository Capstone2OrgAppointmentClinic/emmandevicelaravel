<!DOCTYPE html>
<html lang="en">
  <head>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">

    <!-- Required meta tags -->
  <base href="/public">
    <style type="text/css">

    label
    {
      display: inline:block;
      
      width: 100px;
    }
    </style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    @include('admin.css')

  </head>
  <body style=" background: url('assets/img/adminimg/sendemail1.png') no-repeat center center fixed; background-size: cover;">
  
  <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="">
            <div class="ps-lg-1">
              <div class="d-flex align-items-center justify-content-between">
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
            </div>
          </div>
        </div>
      </div>  
      <!-- partial:partials/_sidebar.html -->
 
      @include('admin.sidebar')
       @include('admin.navbar')

        <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        
      

        <div class="container" align="center" style="padding-top:100px;">

        
        @if(session()->has('message'))

        <div class="alert alert-success">

        <button type="button" class="close" data-dismiss="alert"></button>

        {{session()->get('message')}}
 
        </div>

        @endif
        
        <div>
          <h1 style="font-size: 52px; color:#f7a15c  ;" class="mb-4"><i class="bi bi-envelope" style="color: #f7a15c;"></i> New message </h1>
        </div>

        <form action="{{url('sendemail',$data->id)}}" method="POST">
            @csrf

        <div style="padding: 15px;">

        <input type="text" style="color:black; height: 34px;" class="rounded-lg w-[22rem] p-4" name="subject" required="" placeholder="Header of your email">
        </div>

        <div style="padding:15px;">

          <input type="text" style="color:black; height: 34px;" class="rounded-lg w-[22rem] p-4" name="greeting" required="" placeholder="Subject of your email">
 
        </div>

        <div style="padding:15px;">
          <textarea style="color:black; height: 114px;" class="rounded-lg w-[22rem]" name="message" required placeholder="Purpose of your email"></textarea>
</div>


        <!-- <div style="padding:15px;">

          
          <input type="text" style="color:black; height: 34px;" class="rounded-lg  w-[22rem] p-4" name="actiontext" required="" placeholder="">
 
        </div>

        <div style="padding:15px;">

        
          <input type="text" style="color:black; height: 34px;" class="rounded-lg  w-[22rem] p-4" name="actionurl">
 
        </div>

        <div style="padding:15px;">

       
          <input type="text" style="color:black; height: 34px;" class="rounded-lg  w-[22rem] p-4" name="endpart" required="">
 
        </div> -->

     
        <div style="padding:15px;" class="flex justify-center">

        
        <input type="submit" class="btn btn-success w-[166px] h-[50px] rounded-lg" value="Send Email" style="background-color: #f7a15c; color: white; font-size: 20px; font-weight: bold;">

        </div>
        
    
            </div>
         </form>
        </div>
     </div>
     <!-- Logs History Modal -->
<div class="modal fade" id="logsModal" tabindex="-1" aria-labelledby="logsModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 90%; max-height: 350px;">
        <div class="modal-content" style="max-height: 350px;">
            <div class="modal-header d-flex justify-content-between align-items-center" style="background-color: #f8f9fa; color:black;">
                <h5 class="modal-title" id="logsModalLabel">Logs History</h5>
                <div class="btn-group" style="padding-left:20px;">
                    <button class="btn btn-sm btn-outline-primary" id="showStudentLogsBtn">Student Logs</button>
                    <button class="btn btn-sm btn-outline-success" id="showAdminLogsBtn">Admin Logs</button>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="background-color:white; color: #000; display: table;">
                <!-- Student Logs Section -->
                <div id="studentLogsSection" >
                    <h4>Student Logs</h4>

                     <!-- 🔍 Search Input --> 
                <input type="text" class="form-control mb-2 search-input" style="width:250px;" id="studentSearchInput" placeholder="Search student name">
                      
                <div class="table-wrapper" style="max-height: 350px; overflow-y: auto;">
                        <table class="table table-bordered mb-0"style="width: 100%; border-collapse: collapse; table-layout: fixed ;">
                            <thead class="table-light" style="top: 0; z-index: 1;">
                                <tr>
                                    <th style="width: 33.33%;">Student Name</th>
                                    <th style="width: 33.33%;">Login Time</th>
                                    <th style="width: 33.33%;">Logout Time</th>
                                </tr>
                            </thead>
                            <tbody class="scrollable-tbody">
                                @foreach($logs->where('student.usertype', 0) as $log)
                                    <tr>
                                        <td>{{ $log->student->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($log->login_at)->format('Y-m-d h:i A') }}</td>
                                        <td>{{ $log->logout_at ? \Carbon\Carbon::parse($log->logout_at)->format('Y-m-d h:i A') : '—' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

<style>
    .search-input {
    color: black;
    background-color: white;
}

.search-input:focus {
    background-color: white;
    color: black;
    border-color: gray;
    box-shadow: none;
}
</style>
                <!-- Admin Logs Section -->
                <div id="adminLogsSection" style="display: none;">
                    <h4>Admin Logs</h4>
                
                <!-- 🔍 Search Input -->
                <input type="text" class="form-control mb-2 search-input" id="adminSearchInput" style="width:250px;" placeholder="Search admin name...">
 
                    <div class="table-wrapper" style="max-height: 350px; overflow-y: auto; background-color: #f8f9fa">
                        <table class="table table-bordered mb-0" style="width: 100%; border-collapse: collapse; table-layout: fixed ;">
                            <thead class="table-light" style="top: 0; z-index: 1;">
                                <tr>
                                    <th style="width: 33.33%;">Admin Name</th>
                                    <th style="width: 33.33%;">Login Time</th>
                                    <th style="width: 33.33%;">Logout Time</th>
                                </tr>
                            </thead>
                            <tbody class="scrollable-tbody">
                                @foreach($logs->where('student.usertype', '!=', 0) as $log)
                                    <tr>
                                        <td>{{ $log->student->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($log->login_at)->format('Y-m-d h:i A') }}</td>
                                        <td>{{ $log->logout_at ? \Carbon\Carbon::parse($log->logout_at)->format('Y-m-d h:i A') : '—' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const studentBtn = document.getElementById("showStudentLogsBtn");
    const adminBtn = document.getElementById("showAdminLogsBtn");
    const studentSection = document.getElementById("studentLogsSection");
    const adminSection = document.getElementById("adminLogsSection");

    studentBtn.addEventListener("click", () => {
        studentSection.style.display = "block";
        adminSection.style.display = "none";
    });

    adminBtn.addEventListener("click", () => {
        studentSection.style.display = "none";
        adminSection.style.display = "block";
    });

    const studentSearchInput = document.getElementById("studentSearchInput");
    studentSearchInput.addEventListener("keyup", function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll("#studentLogsSection table tbody tr");
        rows.forEach(row => {
            const nameCell = row.querySelector("td");
            if (nameCell && nameCell.textContent.toLowerCase().includes(filter)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });

    const adminSearchInput = document.getElementById("adminSearchInput");
    adminSearchInput.addEventListener("keyup", function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll("#adminLogsSection table tbody tr");
        rows.forEach(row => {
            const nameCell = row.querySelector("td");
            if (nameCell && nameCell.textContent.toLowerCase().includes(filter)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
});
</script>


@if(request()->has('logs'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var logsModal = new bootstrap.Modal(document.getElementById('logsModal'));
            logsModal.show();

            if (window.history.replaceState) {
                const url = new URL(window.location);
                url.searchParams.delete('logs');
                window.history.replaceState({}, document.title, url.pathname + url.search);
            }
        });
    </script>
@endif

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('input', function () {
      const filter = searchInput.value.toLowerCase();
      const rows = document.querySelectorAll('table tbody tr');

      rows.forEach(row => {
        const statusCell = row.querySelector('td:nth-child(7)');
        if (statusCell) {
          const statusText = statusCell.textContent.toLowerCase();
          if (statusText.includes(filter)) {
            row.style.display = '';
          } else {
            row.style.display = 'none';
          }
        }
      });
    });
  });
</script>

     
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="admin/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="admin/assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="admin/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="admin/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="admin/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <script src="admin/assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="admin/assets/js/off-canvas.js"></script>
    <script src="admin/assets/js/hoverable-collapse.js"></script>
    <script src="admin/assets/js/settings.js"></script>
    <script src="admin/assets/vendors/js/vendor.bundle.base.js"></script>
  </body>
</html>