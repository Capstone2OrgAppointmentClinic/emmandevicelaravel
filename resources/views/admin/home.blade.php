<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    @include('admin.script')
</head>
<body style="background-color: #FAEBD7;">
    <div class="container-scroller w-full">
        @include('admin.sidebar')
        @include('admin.navbar')

       

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

      <div class="main-panel w-full">
         <div class="content-wrapper flex flex-col " style="background-color: #FAEBD7;">
     <div class="justify-center p-6 flex-wrap gap-4 md:flex-row md:items-center">

         <!-- Users Button Box -->
         <button id="toggleUsers" class="btn box-btn" style="height: auto; width: 260px; padding: 20px 30px; margin: 15px; background-color: #AD1457; color: white; border-radius: 15px; border: none; box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3); transition: all 0.3s ease;">
             <div class="btn-content" style="display: flex; align-items: center; justify-content: space-between;">
                 <i class="fas fa-user" style="font-size: 40px;"></i>
                 <div style="text-align: right;">
                     <h3 style="font-size: 24px; font-weight: 600; margin: 0;">Users</h3>
                     <p style="font-size: 32px; font-weight: 700; margin: 5px 0;">{{ count($users ?? []) }}</p>
                 </div>
             </div>
         </button>

         <!-- Appointment Button Box -->
         <button id="toggleAppointment" class="btn box-btn" style="height: auto; width: 260px; padding: 20px 30px; margin: 15px; background-color: #AD1457; color: white; border-radius: 15px; border: none; box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3); transition: all 0.3s ease;">
        <div class="btn-content" style="display: flex; align-items: center; justify-content: space-between;">
        <i class="fas fa-calendar-check" style="font-size: 40px;"></i>
        <div style="text-align: right;">
            <h3 style="font-size: 24px; font-weight: 600; margin: 0;">Appointment</h3>
            <p style="font-size: 32px; font-weight: 700; margin: 5px 0;">↓</p>
        </div>
        </div>
        </button>

         <!-- Availability Button Box -->
         <button id="toggleAvailability" class="btn box-btn" style="height: auto; width: 260px; padding: 20px 30px; margin: 15px; background-color: #AD1457; color: white; border-radius: 15px; border: none; box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3); transition: all 0.3s ease;">
             <div class="btn-content" style="display: flex; align-items: center; justify-content: space-between;">
                 <i class="fas fa-clock" style="font-size: 40px;"></i>
                 <div style="text-align: right;">
                     <h3 style="font-size: 24px; font-weight: 600; margin: 0;">Availability</h3>
                     <p style="font-size: 32px; font-weight: 700; margin: 5px 0;">↓</p>
                 </div>
             </div>
         </button>

         <!-- Equipment Button Box -->
         <button id="toggleEquipment" class="btn box-btn" style="height: auto; width: 260px; padding: 20px 30px; margin: 15px; background-color: #AD1457; color: white; border-radius: 15px; border: none; box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3); transition: all 0.3s ease;">
             <div class="btn-content" style="display: flex; align-items: center; justify-content: space-between;">
                 <i class="fas fa-toolbox" style="font-size: 40px;"></i>
                 <div style="text-align: right;">
                     <h3 style="font-size: 24px; font-weight: 600; margin: 0;">Equipment</h3>
                     <p style="font-size: 32px; font-weight: 700; margin: 5px 0;">↓</p>
                 </div>
             </div>
         </button>
         </div>
    @include('admin.buttoncss')
   
    <div id="userTable" style="display: none; margin-top: 20px;">
    <h3 style="margin-left: 12px; color: black;">User's Information</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Student ID</th>
                    <th>Year Level</th> 
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td style="color: #778899;">{{ $user->name }}</td>
                        <td style="color: #778899;">{{ $user->email }}</td>
                        <td style="color: #778899;">{{ $user->student_id }}</td>
                        <td style="color: #778899;">{{ $user->year_level }}</td>
                        <td>
                        <button class="btn btn-primary viewUser" 
                         data-name="{{ $user->name}}" 
                         data-email="{{ $user->email}}" 
                         data-phone="{{ $user->phone}}" 
                         data-address="{{ $user->address}}"
                         data-course="{{ $user->course}}" 
                         data-student-id="{{ $user->student_id}}"
                         data-education="{{ ucfirst($user->education_level)}}"
                         data-year="{{ $user->year_level}}"
                         data-bs-toggle="modal" data-bs-target="#viewUserModal">
                         View
                        </button>
                        <a href="{{ url('/editUser', $user->id) }}" class="btn btn-warning">Edit</a>
                        <a class="btn btn-danger" onclick="return confirm('are you sure to delete this')" href="{{url('deleteUser',$user->id)}}">Delete</a>
                        </td>
                    </tr>
                  @endforeach
               </tbody>
            </table>
         </div>

        <script>
        document.getElementById('toggleUsers').addEventListener('click', function() {
        let userTable = document.getElementById('userTable');
        let userCount = this.getAttribute('data-user-count')

        if (userTable.style.display === 'none') {
            userTable.style.display = 'block';
          
        } else {
            userTable.style.display = 'none';
           
        }
    });
    </script>

  <div class="modal fade" id="viewUserModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User Info</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <span id="modalUserName"></span></p>
                <p><strong>Email:</strong> <span id="modalUserEmail"></span></p>
                <p><strong>Phone:</strong> <span id="modalUserPhone"></span></p>
                <p><strong>Address:</strong> <span id="modalUserAddress"></span></p>
                <p><strong>Course:</strong> <span id="modalUserCourse"></span></p>
                <p><strong>Student ID:</strong> <span id="modalStudentId"></span></p>
                <p><strong>Education Level:</strong> <span id="modalEducation"></span></p>
                <p><strong>Year Level:</strong> <span id="modalYear"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
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

            // Optional: Clean the URL after showing the modal
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

</body>
</html>
