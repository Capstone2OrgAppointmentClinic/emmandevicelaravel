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
<div class="modal fade" id="logsModal" tabindex="-1" aria-labelledby="logsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="max-width: 90%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logsModalLabel">Logs History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="background-color: white;">
            <div id="logsContent">
                <!-- Student Logs -->
                <h4>Student Logs</h4>
                <div class="table-wrapper">
                    <table class="table table-bordered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Student Name</th>
                                <th>Login Time</th>
                                <th>Logout Time</th>
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

                <!-- Admin Logs -->
                <h4 class="mt-5">Admin Logs</h4>
                <div class="table-wrapper">
                    <table class="table table-bordered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Admin Name</th>
                                <th>Login Time</th>
                                <th>Logout Time</th>
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

               <!-- Pagination -->
              <div class="mt-3">
              {{ $logs->appends(['logs' => 1])->links() }}
                 </div>
            </div>
        </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
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

<style>
.table-wrapper {
    max-height: 300px;
    overflow-y: auto;
}

.scrollable-tbody {
    display: block;
    overflow-y: auto;
}

.scrollable-tbody tr {
    display: table;
    width: 100%;
    table-layout: fixed;
}

.table thead,
.table tbody tr {
    width: 100%;
    display: table;
    table-layout: fixed;
}

.table thead {
    position: sticky;
    top: 0;
    z-index: 2;
    background-color: #f8f9fa;
}
.modal-content {
    background-color: #fff;
}

.modal-header,
.modal-body,
.modal-footer {
    background-color: #fff;
    color: #000;
}
</style>     
    
  </body>
</html>