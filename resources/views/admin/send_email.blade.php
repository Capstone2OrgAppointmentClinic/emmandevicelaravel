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

      <!-- partial -->
     
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

/* Fix white background */
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


    <!-- container-scroller -->
    <!-- plugins:js -->
    
    <!-- End custom js for this page -->
  </body>
</html>