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
            <p style="font-size: 32px; font-weight: 700; margin: 5px 0;">{{ count($appointments ?? []) }}</p>
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
         </div>
    @include('admin.buttoncss')
   
    <div id="userTable" style="display: none; margin-top: 20px;">
        <h3 style="margin-left: 12px; color: black; font-size: 32px;" class="flex justify-center w-full items-center">User's Information</h3>
        <x-input placeholder="Search Student I.D or Name " class=" my-4" style="width:17rem; color: black;"></x-input>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th  style="width: 50px; word-wrap: break-word; white-space: normal;">Student Name</th>
                    <th style="width: 50px; word-wrap: break-word; white-space: normal;">Email</th>
                    <th style="width: 50px; word-wrap: break-word; white-space: normal;">Student ID</th>
                    <th style="width: 50px; word-wrap: break-word; white-space: normal;">Year Level</th> 
                    <th style="width: 50px; word-wrap: break-word; white-space: normal;">Status</th>
                   
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td style="color: black;" style="width: 50px; word-wrap: break-word; white-space: normal;">{{ $user->name }}</td>
                        <td style="color: black;" style="width: 50px; word-wrap: break-word; white-space:normal;">{{ $user->email }}</td>
                        <td style="color: black;" style="width: 50px; word-wrap: break-word; white-space: normal;">{{ $user->student_id }}</td>
                        <td style="color: black;" style="width: 50px; word-wrap: break-word; white-space: normal;">{{ $user->year_level }}</td>
                        <td >
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
                        <a href="{{ url('/editUser', $user->id) }}" class="btn btn-warning">Update</a>
                        <a class="btn btn-danger" onclick="return confirm('are you sure to delete this')" href="{{url('deleteUser',$user->id)}}">Delete</a>
                        </td>
                     
                    </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
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
<div id="appointmentTable" style="display: none; margin-top: 20px;">
    <h3 style="margin-left: 12px; color: black;">Appointment Details</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Service</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Info</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
                <tr>
                    <td style="color: #778899;">{{ $appointment->name }}</td>
                    <td style="color: #778899;">{{ $appointment->service }}</td>
                    <td style="color: #778899;">{{ $appointment->date }}</td>
                    <td style="color: #778899;">{{ $appointment->time }}</td>
                    <td style="color: #778899;">{{ ucfirst($appointment->status) }}</td>
                    <td>
                        <button class="btn btn-primary viewAppointment" 
                            data-name="{{ $appointment->name }}"
                            data-email="{{ $appointment->email }}"
                            data-phone="{{ $appointment->phone }}"
                            data-service="{{ $appointment->service }}"
                            data-date="{{ $appointment->date }}"
                            data-time="{{ $appointment->time }}"
                            data-message="{{ $appointment->message }}"
                            data-status="{{ $appointment->status }}"
                            data-bs-toggle="modal" 
                            data-bs-target="#viewAppointmentModal">
                            View
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="modal fade" id="viewAppointmentModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Appointment Info</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <span id="modalAppName"></span></p>
                <p><strong>Email:</strong> <span id="modalAppEmail"></span></p>
                <p><strong>Phone:</strong> <span id="modalAppPhone"></span></p>
                <p><strong>Service:</strong> <span id="modalAppService"></span></p>
                <p><strong>Date:</strong> <span id="modalAppDate"></span></p>
                <p><strong>Time:</strong> <span id="modalAppTime"></span></p>
                <p><strong>Message:</strong> <span id="modalAppMessage"></span></p>
                <p><strong>Status:</strong> <span id="modalAppStatus"></span></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('toggleAppointment').addEventListener('click', function () {
        let appointmentTable = document.getElementById('appointmentTable');
        if (appointmentTable.style.display === 'none') {
            appointmentTable.style.display = 'block';
        } else {
            appointmentTable.style.display = 'none';
        }
    });

    document.querySelectorAll('.viewAppointment').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('modalAppName').textContent = this.dataset.name;
            document.getElementById('modalAppEmail').textContent = this.dataset.email;
            document.getElementById('modalAppPhone').textContent = this.dataset.phone;
            document.getElementById('modalAppService').textContent = this.dataset.service;
            document.getElementById('modalAppDate').textContent = this.dataset.date;
            document.getElementById('modalAppTime').textContent = this.dataset.time;
            document.getElementById('modalAppMessage').textContent = this.dataset.message;
            document.getElementById('modalAppStatus').textContent = this.dataset.status;
        });
    });
</script>

<!-- Logs History Modal -->
<div class="modal fade" id="logsModal" tabindex="-1" aria-labelledby="logsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="max-width: 90%;">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h5 class="modal-title" id="logsModalLabel">Logs History</h5>
                <div class="btn-group" style="padding-left:20px;">
                    <button class="btn btn-sm btn-outline-primary" id="showStudentLogsBtn">Student Logs</button>
                    <button class="btn btn-sm btn-outline-success" id="showAdminLogsBtn">Admin Logs</button>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- Student Logs Section -->
                <div id="studentLogsSection">
                    <h4>Student Logs</h4>

                     <!-- 🔍 Search Input -->
                <input type="text" class="form-control mb-2 search-input" id="studentSearchInput" placeholder="Search student name...">
                      
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
                </div>

                <!-- Admin Logs Section (Hidden by default) -->
                <div id="adminLogsSection" style="display: none;">
                    <h4>Admin Logs</h4>
                
                <!-- 🔍 Search Input -->
                <input type="text" class="form-control mb-2 search-input" id="adminSearchInput" placeholder="Search admin name...">

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
                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $logs->appends(['logs' => 1])->links() }}
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

<style>
.table-wrapper {
    max-height: 350px;
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

.modal-content,
.modal-header,
.modal-body,
.modal-footer {
    background-color: #fff;
    color: #000;
}
.search-input {
    color: black;
    background-color: white;
    border: 1px solid #ccc;
}

.search-input:focus {
    background-color: white;
    color: black;
    border-color: gray;
    box-shadow: none;
}
</style>

</body>
</html>
