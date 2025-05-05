<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
 
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="{{ asset('assets/img/adminimg/titlebaricon.ico') }}" type="image/icon">
    <style>
    .statusbtn {
        padding: 10px 15px;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .statusbtn:hover {
        background-color: #45a049;
        transform: scale(1.05);
        /* box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); */
    }
    .modal-footer .btn {
        transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d !important;
        color: white !important;
        border-color: #6c757d !important;
    }

    .btn-danger:hover {
        background-color: #c82333 !important;
        border-color: #bd2130 !important;
    }
</style>
</head>
<body style="background-color: #FAEBD7;">
    <div class="container-scroller w-full">
        @include('admin.sidebar')
        @include('admin.navbar')
        <div class="main-panel w-full">
            <div class="content-wrapper flex flex-col" style="background-color: #FAEBD7;">
                <div class="justify-center p-6 flex-wrap gap-3 md:flex-row md:items-center flex w-full items-center" style="justify-content: space-between;">
                    <!-- Users Button Box -->
                    <button id="toggleUsers" class="btn box-btn" style="height: auto; width: 260px; padding: 20px 30px; margin: 15px; background-color: #AD1457; color: white; border-radius: 15px; border: none; box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3); transition: all 0.3s ease;">
                        <div class="btn-content" style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 10px;">
                            <i class="fas fa-user" style="font-size: 40px;"></i>
                            <div style="text-align: right;">
                                <h3 style="font-size: 24px; font-weight: 600; margin: 0;">Students</h3>
                                <p style="font-size: 32px; font-weight: 700; margin: 5px 0;">{{ count($users ?? []) }}</p>
                            </div>
                        </div>
                    </button>
                    <!-- Appointment Button Box -->
                    <button id="toggleAppointment" class="btn box-btn" style="height: auto; width: 260px; padding: 20px 30px; margin: 15px; background-color: #AD1457; color: white; border-radius: 15px; border: none; box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3); transition: all 0.3s ease;">
                        <div class="btn-content" style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 10px;">
                            <i class="fas fa-calendar-check" style="font-size: 40px;"></i>
                            <div style="text-align: right;">
                                <h3 style="font-size: 24px; font-weight: 600; margin: 0;">Appointment</h3>
                                <p style="font-size: 32px; font-weight: 700; margin: 5px 0;">{{ count($appointments ?? []) }}</p>
                            </div>
                        </div>
                    </button>
                    
                </div>
                @include('admin.buttoncss')
                <!-- Users Table -->
                <div id="userTable" style="display: none; margin-top: 20px; margin-right: -20px;">
                    <div class="table-responsive">
                        <table class="table table-striped">
                        <x-input placeholder="Search by Student ID, Name, or Email" class="mb-4" style="width: 300px; color: black;" id="studentId"></x-input>
                      
<script>
    document.getElementById('studentId').addEventListener('keyup', function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#userTable tbody tr');

        rows.forEach(row => {
            const studentId = row.cells[1].textContent.toLowerCase();
            const studentName = row.cells[2].textContent.toLowerCase();
            const studentEmail = row.cells[3].textContent.toLowerCase();

            if (studentId.includes(filter) || studentName.includes(filter) || studentEmail.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script> <!-- This is script use for  Search bar for User in Dashboard  of Admin Panel Users, can able to search name and student ID-->

                            <thead>
                                <tr>
                                    <th style=" color: black;">#</th>
                                    <th style=" margin-right: 10px; color: black;">Student ID</th>
                                    <th style=" color:black;">Student Name</th>
                                    <th style="text-align:center; color: black;">Email</th>
                                    <th style=" color: black;">Year Level</th>
                                    <th style="text-align:center; color: black;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td class=" cell-text" style=" color: #AD1457; font-weight: bold; text-transform: uppercase;">{{ $user->id }}</td>
                                        <td class="cell-text" style=" color: #AD1457; font-weight: bold; text-transform: uppercase;">{{ $user->student_id }}</td>
                                        <td class="cell-text" style=" color: #AD1457; font-weight: bold;">{{ $user->name }}</td>
                                        <td class="cell-text" style=" color: #AD1457; font-weight: bold;">{{ $user->email }}</td>
                                        <td class="cell-text" style=" color: #AD1457; font-weight: bold;">{{ $user->year_level }}</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn btn-primary btn-sm viewUser statusbtn"
                                                    data-name="{{ $user->name }}"
                                                    data-email="{{ $user->email }}"
                                                    data-phone="{{ $user->phone }}"
                                                    data-address="{{ $user->address }}"
                                                    data-course="{{ $user->course }}"
                                                    data-student-id="{{ $user->student_id }}"
                                                    data-education="{{ ucfirst($user->education_level) }}"
                                                    data-year="{{ $user->year_level }}"
                                                    data-bs-toggle="modal" data-bs-target="#viewUserModal">
                                                    View
                                                </button>
                                                <a href="{{ url('/editUser', $user->id) }}" class="btn btn-warning btn-sm statusbtn">Update</a>
                                                <a class="btn btn-danger btn-sm statusbtn" id="viewRemoveModal"  data-bs-toggle="modal" data-bs-target="#myRemoteModal"data-href="{{ url('deleteUser', $user->id) }}" data-name="{{ $user->name }}">Remove</a>
                                                <a href="#" class="btn btn-info btn-sm statusbtn"><i class="fas fa-history"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                                 <!-- Confirmation Remove Modal -->
<div class="modal fade" id="myRemoteModal" tabindex="-1" aria-labelledby="removeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4" style="background-color: #f8f9fa;">

            <!-- Modal Header -->
            <div class="modal-header border-0 pb-0" style="background-color: gray;">
                <h5 class="modal-title fw-bold flex justify-center w-full items-center" id="removeModalLabel" style="font-size: 1.5rem; color: orange; padding-bottom: 1rem;">⚠️ Confirm Deletion</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>

            <!-- Modal Body -->
            <div class="modal-body text-center text-dark py-4">
                <p class="mb-1" style="font-size: 1.1rem;">Are you absolutely sure you want to delete</p>
                <h5 class="fw-semibold text-uppercase text-danger" style="font-size: 1.5rem;"><span id="userName"></span></h5>
                <p class="text-muted">This action cannot be undone.</p>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer border-0 d-flex justify-content-center gap-3 pb-4">
                <button type="button" class="btn btn-outline-secondary px-4 rounded-pill" data-bs-dismiss="modal" style="background-color: gray;">
                    Cancel
                </button>
                <a id="confirmDeleteBtn" href="#" class="btn btn-danger px-4 rounded-pill">
                    Delete
                </a>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('myRemoteModal');
        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const name = button.getAttribute('data-name');
            const href = button.getAttribute('data-href');

            document.getElementById('userName').textContent = name;
            document.getElementById('confirmDeleteBtn').setAttribute('href', href);
        });
    });
</script>


                <!-- Appointment Table -->
                <div id="appointmentTable" style="display: none; margin-top: 20px;">
                    <table class="table table-striped">
                          <!-- Users Table -->
                <div id="userTable" style="display: none; margin-top: 20px;">
                    <div class="table-responsive">
                        <table class="table table-striped">
                        <x-input placeholder="Search records..." class="mb-4" style="width: 300px; color: black;" id="appointmentId"></x-input>
                      
                        <script>
    document.getElementById('appointmentId').addEventListener('keyup', function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#appointmentTable tbody tr');

        rows.forEach(row => {
            const name = row.cells[1].textContent.toLowerCase();
            const service = row.cells[2].textContent.toLowerCase();
            const date = row.cells[3].textContent.toLowerCase();
            const status = row.cells[4].textContent.toLowerCase();
            const time = row.cells[5].textContent.toLowerCase();

            if (service.includes(filter) || name.includes(filter) || date.includes(filter) ||  status.includes(filter) || time.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
    </script>
                        <thead>
                            <tr>
                                <th style=" color: black">AID</th>
                                <th style=" color: black;">Student Name</th>
                                <th style=" color: black;">Service</th>
                                <th style=" color: black;">Date</th>
                                <th style=" color: black;">Time</th>
                                <th style=" color: black;">Status</th>
                                <th style=" color: black;">Student Information</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                                <tr>
                                    <td style="color: #AD1457; font-weight: bold;">{{ $appointment->id }}</td>
                                    <td style="color: #AD1457; font-weight: bold;">{{ $appointment->name }}</td>
                                    <td style="color: #AD1457; font-weight: bold;">{{ $appointment->service }}</td>
                                    <td style="color: #AD1457; font-weight: bold;">{{ $appointment->date }}</td>
                                    <td style="color: #AD1457; font-weight: bold;">{{ \Carbon\Carbon::parse($appointment->time)->format('M d, Y - h:i A') }}</td>
                                    <td style="color: #AD1457; font-weight: bold; text-transform: uppercase;">{{ ucfirst($appointment->status) }}</td>
                                    <td>
                                        <button class="btn btn-primary viewAppointment statusbtn"
                                            data-name="{{ $appointment->name }}"
                                            data-email="{{ $appointment->email }}"
                                            data-phone="{{ $appointment->phone }}"
                                            data-service="{{ $appointment->service }}"
                                            data-date="{{ $appointment->date }}"
                                            data-time="{{ $appointment->time }}"
                                            data-message="{{ $appointment->message }}"
                                            data-status="{{ $appointment->status }}"
                                            data-bs-toggle="modal" data-bs-target="#viewAppointmentModal">
                                            View
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Modals for viewing records -->
               <!-- Modal -->
               <div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered max-w-4/12">
    <div class="modal-content rounded-4 shadow-lg border-0">

      <!-- Modal Header -->
      <div class="modal-header bg-primary text-white rounded-top-4 d-flex justify-start w-full  border-0">
        <i class="bi bi-info-circle-fill me-2 fs-4"></i>
        <h5 class="modal-title fw-semibold" id="viewUserModalLabel  f">
           Information
        </h5>
        <!-- <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>

      <!-- Modal Body -->
      <div class="modal-body bg-white text-dark px-4 py-3">
        <p><strong>Student ID:</strong> <span id="modalUserStudentId"></span></p>
        <p><strong>Name:</strong> <span id="modalUserName"></span></p>
        <p><strong>Email:</strong> <span id="modalUserEmail"></span></p>
        <p><strong>Phone Number:</strong> <span id="modalUserPhone"></span></p>
        <p><strong>Address:</strong> <span id="modalUserAddress"></span></p>
        <p><strong>Course:</strong> <span id="modalUserCourse"></span></p>
        <p><strong>Educational Level:</strong> <span id="modalUserEducational_Level"></span></p>
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer bg-light border-0 rounded-bottom-4 justify-content-center">
        <button type="button" class="btn btn-outline-primary px-4" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

                <div class="modal fade" id="viewAppointmentModal"id="viewUserModal" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewUserModalLabel">User Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <span id="modalUserName"></span></p>
                <p><strong>Name:</strong> <span id="modalUserName"></span></p>
                <p><strong>Name:</strong> <span id="modalUserName"></span></p>
                <p><strong>Name:</strong> <span id="modalUserName"></span></p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>


                </div>
                <!-- Combined Toggle Script -->
                <script>
                    const userTable        = document.getElementById('userTable');
                    const appointmentTable = document.getElementById('appointmentTable');
                    const toggleUsersBtn   = document.getElementById('toggleUsers');
                    const toggleApptBtn    = document.getElementById('toggleAppointment');

                    toggleUsersBtn.addEventListener('click', () => {
                        userTable.style.display        = (userTable.style.display === 'none') ? 'block' : 'none';
                        appointmentTable.style.display = 'none';
                    });

                    toggleApptBtn.addEventListener('click', () => {
                        appointmentTable.style.display = (appointmentTable.style.display === 'none') ? 'block' : 'none';
                        userTable.style.display        = 'none';
                    });
                </script>
                <!-- Remaining scripts unchanged -->
                <script>
    $(document).ready(function(){
        $(".view-message").click(function(){
            var message = $(this).data("message");
            $("#messageContent").text(message);
            $("#messageModal").modal("show");
        });
    });
    </script>
                <script>
    $(document).on("click", ".viewUser", function(){
        $("#modalUserId").text($(this).data("id"));
        $("#modalUserStudentId").text($(this).data("student-id"));
        $("#modalUserName").text($(this).data("name"));
        $("#modalUserEmail").text($(this).data("email"));
        $("#modalUserPhone").text($(this).data("phone"));
        $("#modalUserAddress").text($(this).data("address"));
        $("#modalUserCourse").text($(this).data("course"));
        $("#modalStudentId").text($(this).data("student-id"));
        $("#modalUserEducational_Level").text($(this).data("education"));
        $("#modalYear").text($(this).data("year"));
    });
</script>

<!-- Logs History Modal -->
<div class="modal fade" id="logsModal" tabindex="-1" aria-labelledby="logsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="max-width: 90%;">
        <div class="modal-content" style="background-color:white;">
            <div class="modal-header d-flex justify-content-between align-items-center">

            <div class="btn-group">
                    <button class="btn btn-sm btn-outline-primary" id="showStudentLogsBtn" style="width: 150px;">Student Logs</button>
                    <button class="btn btn-sm btn-outline-success" id="showAdminLogsBtn" style="width: 150px;">Admin Logs</button>
                </div>
<div class="flex justify-center w-full items-center">
<h5 class="modal-title" id="logsModalLabel" style="margin-right: 250px;">Logs History</h5>

</div>


                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- Student Logs Section -->
                <div id="studentLogsSection">
      

                     <!-- 🔍 Search Input -->
                <input type="text" class="form-control mb-2 search-input" style="width:250px;background-color:white;color:black;" id="studentSearchInput" placeholder="Search student name">
                      
                <div class="table-wrapper table-responsive" style=" max-height: 350px;">
                        <table class="table table-bordered mb-0 ">
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

                <!-- Admin Logs Section -->
                <div id="adminLogsSection" style="display: none;">
             
                
                <!-- 🔍 Search Input -->
                <input type="text" class="form-control mb-2 search-input" id="adminSearchInput" style="width:250px; background-color:white;color:black;" placeholder="Search admin name...">
 
                    <div class="table-wrapper" style=" max-height: 350px;overflow-y: auto;">
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

                

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
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
            </div>
        </div>
        @include('admin.script')
    </div>
    </body>
</html>