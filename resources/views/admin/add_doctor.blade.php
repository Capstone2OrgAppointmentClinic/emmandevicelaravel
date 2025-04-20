<!DOCTYPE html>
<html lang="en">
  <head>

    <style type="text/css">

    label
    {
      display: inline:block;
      
      width: 100px;
    }
    </style>

    
    @include('admin.css')

  </head>
  <body style="background-color: #FAEBD7;">
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

      <!-- partial -->
     
       @include('admin.navbar')

        <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        
      <div class="container" align="center" style="padding-top:50px;">
    <div style="width: 500px; background-color: #f9f9f9; padding: 30px; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.2); text-align: center;">

        @if(session()->has('message'))
        <div class="alert alert-success" style="margin-bottom: 20px; padding: 10px; border-radius: 5px;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session()->get('message') }}
        </div>
        @endif

        <form action="{{ url('upload_doctor') }}" method="POST" enctype="multipart/form-data" style="text-align: left;">
            @csrf

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">Doctor Name</label>
                <input type="text" name="name" placeholder="Write Doctor Name" required
                    style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; color: #333; font-size: 16px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">Phone</label>
                <input type="text" name="number" placeholder="Write the Number" required
                    style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; color: #333; font-size: 16px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">Speciality</label>
                <select name="speciality" required
                    style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; color: #333; font-size: 16px;">
                    <option value="">Select Speciality</option>
                    <option value="head nurse">Clinic Staff</option>
                    <option value="nurse">Registered Nurse</option>
                    <option value="Physicians">Physician / Surgeon</option>
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">Doctor Image</label>
                <input type="file" name="file" required
                    style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; color: #333; font-size: 16px;">
            </div>

            <div style="text-align: center;">
                <input type="submit" class="btn btn-success"
                    style="background-color: #28a745; color: #fff; padding: 12px 25px; border-radius: 8px; border: none; cursor: pointer; font-size: 18px; transition: all 0.3s;">
            </div>
        </form>
    </div>
</div>
<!-- Logs History Modal -->
<div class="modal fade" id="logsModal" tabindex="-1" aria-labelledby="logsModalLabel">
    <div class="modal-dialog" style="max-width: 90%;">
        <div class="modal-content">
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
                            <thead class="table-light" style="top: 0; z-index: 1; background-color: #AD1457">
                                <tr>
                                    <th style="width: 33.33%;black;font-size:20px;">Student Name</th>
                                    <th style="width: 33.33%;black;font-size:20px;">Login Time</th>
                                    <th style="width: 33.33%;black;font-size:20px;">Logout Time</th>
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
                                    <th style="width: 33.33%;black;font-size:18px;">Admin Name</th>
                                    <th style="width: 33.33%;black;font-size:18px;">Login Time</th>
                                    <th style="width: 33.33%;black;font-size:18px;">Logout Time</th>
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
@include('admin.script')

  </body>
</html>