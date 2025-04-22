<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    @include('admin.script')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="{{ asset('assets/img/adminimg/titlebaricon.ico') }}" type="image/icon">
</head>
<body style="background-color: #FAEBD7;">
    <div class="container-scroller w-full">
        @include('admin.sidebar')
        @include('admin.navbar')
        <div class="main-panel w-full">
            <div class="content-wrapper flex flex-col" style="background-color: #FAEBD7;">
                <div class="justify-center p-6 flex-wrap gap-3 md:flex-row md:items-center flex w-full items-center" style="justify-content: space-between;">
                    <!-- Users Button Box -->
                    <button id="toggleUsers" class="btn box-btn" style="height: auto; width: 320px; padding: 20px 30px; margin: 15px; background-color: #AD1457; color: white; border-radius: 15px; border: none; box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3); transition: all 0.3s ease;">
                        <div class="btn-content" style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 10px;">
                            <i class="fas fa-user" style="font-size: 40px;"></i>
                            <div style="text-align: right;">
                                <h3 style="font-size: 24px; font-weight: 600; margin: 0;">Users</h3>
                                <p style="font-size: 32px; font-weight: 700; margin: 5px 0;">{{ count($users ?? []) }}</p>
                            </div>
                        </div>
                    </button>
                    <!-- Appointment Button Box -->
                    <button id="toggleAppointment" class="btn box-btn" style="height: auto; width: 320px; padding: 20px 30px; margin: 15px; background-color: #AD1457; color: white; border-radius: 15px; border: none; box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3); transition: all 0.3s ease;">
                        <div class="btn-content" style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 10px;">
                            <i class="fas fa-calendar-check" style="font-size: 40px;"></i>
                            <div style="text-align: right;">
                                <h3 style="font-size: 24px; font-weight: 600; margin: 0;">Appointment</h3>
                                <p style="font-size: 32px; font-weight: 700; margin: 5px 0;">{{ count($appointments ?? []) }}</p>
                            </div>
                        </div>
                    </button>
                    <!-- Availability Button Box -->
                    <button id="toggleAvailability" class="btn box-btn" style="height: auto; width: 320px; padding: 20px 30px; margin: 15px; background-color: #AD1457; color: white; border-radius: 15px; border: none; box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3); transition: all 0.3s ease;">
                        <div class="btn-content" style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 10px;">
                            <i class="	fas fa-capsules" style="font-size: 40px;"></i>
                            <div style="text-align: right;">
                                <h3 style="font-size: 24px; font-weight: 600; margin: 0;">Medicine</h3>
                                <p style="font-size: 32px; font-weight: 700; margin: 5px 0;">↓</p>
                            </div>
                        </div>
                    </button>
                </div>
                @include('admin.buttoncss')
                <!-- Users Table -->
                <div id="userTable" style="display: none; margin-top: 20px;">
                    <div class="table-responsive">
                        <table class="table table-striped">
                        <x-input placeholder=" Student ID or Name" class="mb-4" style="width: 270px; color: black;" id="studentId"></x-input>
                      
<script>
    document.getElementById('studentId').addEventListener('keyup', function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#userTable tbody tr');

        rows.forEach(row => {
            const studentId = row.cells[1].textContent.toLowerCase();
            const studentName = row.cells[2].textContent.toLowerCase();

            if (studentId.includes(filter) || studentName.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

                            <thead>
                                <tr>
                                    <th style=" color: black;">#</th>
                                    <th style=" margin-right: 10px; color: black;">Student ID</th>
                                    <th style=" color:black;">Student Name</th>
                                    <th style="text-align:center; color: black;">Email</th>
                                    <th style=" color: black;">Year Level</th>
                                    <th style="text-align:center;">Status</th>
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
                                                <button class="btn btn-primary btn-sm viewUser"
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
                                                <a href="{{ url('/editUser', $user->id) }}" class="btn btn-warning btn-sm">Update</a>
                                                <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this?')" href="{{ url('deleteUser', $user->id) }}">Delete</a>
                                                <a href="#" class="btn btn-info btn-sm"><i class="fas fa-history"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Appointment Table -->
                <div id="appointmentTable" style="display: none; margin-top: 20px;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style=" color: black">AID</th>
                                <th style=" color: black;">Student Name</th>
                                <th style=" color: black;">Service</th>
                                <th style=" color: black;">Date</th>
                                <th style=" color: black;">Time</th>
                                <th style=" color: black;">Status</th>
                                <th style=" color: black;">Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                                <tr>
                                    <td style="color: #AD1457; font-weight: bold;">{{ $appointment->id }}</td>
                                    <td style="color: #AD1457; font-weight: bold;">{{ $appointment->name }}</td>
                                    <td style="color: #AD1457; font-weight: bold;">{{ $appointment->service }}</td>
                                    <td style="color: #AD1457; font-weight: bold;">{{ $appointment->date }}</td>
                                    <td style="color: #AD1457; font-weight: bold;">{{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}</td>
                                    <td style="color: #AD1457; font-weight: bold; text-transform: uppercase;">{{ ucfirst($appointment->status) }}</td>
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
                <div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title flex justify-center w-full items-center text-lg" id="viewUserModalLabel">{{ $appointment->name }} Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>I.D: </strong><span id="modalUserId"></span></p>
                <p><strong>Student ID: </strong><span id="modalUserStudentId"></span></p>
                <p><strong>Name: </strong> <span id="modalUserName"></span></p>
                <p><strong>Email: </strong> <span id="modalUserEmail"></span></p>
                <p><strong>Phone Number: </strong> <span id="modalUserPhone"></span></p>
                <p><strong>Address: </strong> <span id="modalUserAddress"></span></p>
                <p><strong>Course: </strong> <span id="modalUserCourse"></span></p>
                <p><strong>Educational Level: </strong> <span id="modalUserEducational_Level    "></span></p>
           

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
            </div>
        </div>
    </div>
    </body>
</html>