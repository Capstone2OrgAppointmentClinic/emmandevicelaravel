<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="{{ asset('assets/img/adminimg/titlebaricon.ico') }}" type=" image/icon">
    <!-- Required meta tags -->
    @include('admin.css')
    <style>
        body {
            background-color: #FAEBD7;
        }

        .table-container {
            margin-top: 50px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 90%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #AD1457;
            color: white;
            font-size: 16px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        img {
            border-radius: 8px;
        }

        .btn {
            padding: 8px 12px;
            font-size: 14px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #d9534f;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>

<link href="/src/styles.css" rel="stylesheet">
</head>
<body>
    <div class="container-scroller">
        <!-- Sidebar -->
        @include('admin.sidebar')

        <!-- Navbar -->
        @include('admin.navbar')

        <!-- Main Content -->
        <div class="container-fluid page-body-wrapper">
            <div class="container d-flex justify-content-center">
                <div class="table-container">
                    <h2 class="text-center" style="color: #333; font-size: 32px;">Manage Doctors</h2>
                    <a href="{{ url('add_doctor_view') }}" class="btn text-white" style="background-color: #AD1457;">Add Doctor</a>                    <table>
                        <thead>
                            <tr>
                                <th class="bg-[#AD1457]">Doctor Name</th>
                                <th class="bg-[#AD1457]">Phone</th>
                                <th class="bg-[#AD1457]">Speciality</th>
                                <th class="bg-[#AD1457]">Image</th >
                                <th class="bg-[#AD1457]">Update</th>
                                <th class="bg-[#AD1457]">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $doctor)
                            <tr>
                                <td style="color: #333; font-weight: 500;">{{ $doctor->name }}</td>
                                <td style="color: #333; font-weight: 500;">{{ $doctor->phone }}</td>
                                <td style="color: #333; font-weight: 500;">{{ $doctor->speciality }}</td>
                                <td><img height="100" width="100" src="doctorimage/{{ $doctor->image }}"></td>
                                <td>
                                    <a class="btn btn-primary" href="{{ url('updatedoctor', $doctor->id) }}">Update</a>
                                </td>
                                <td><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"  data-url="{{ url('removedoctor', $doctor->id) }}" data-doctor-name="{{ $doctor->name }}">Remove
    </button>
</td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<!-- Confirm Delete Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Removal</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mt-2">
             <span class=" text-lg">Are you sure you want to remove <span id="doctorName" style="font-weight: bold;"></span> ?</span><br>
                <!-- <h1 style="color:  gray; font-size:  12px;"> This will be not dispaly in the Health Care Teams section if you proceed to remove</h1> -->
            </div>
            <div class="flex w-full justify-end items-end p-4">
                <button type="button" class="btn btn-secondary mr-4" data-bs-dismiss="modal">Cancel</button>
                <a id="confirmDeleteBtn" href="#" class="btn btn-danger">Yes, Remove</a>
            </div>
        </div>
    </div>
</div>

`
<script>
    const confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const url = button.getAttribute('data-url');
        const doctorName = button.getAttribute('data-doctor-name'); // Get the doctor's name

        // Set the doctor's name inside the modal body
        document.getElementById('doctorName').textContent = doctorName;

        // Set the URL for the confirm button
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        confirmBtn.setAttribute('href', url);
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
                <input type="text" class="form-control mb-2 search-input" style="width:250px;" id="studentSearchInput" placeholder="Search student name">
                      
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

                <!-- Admin Logs Section -->
                <div id="adminLogsSection" style="display: none;">
                    <h4>Admin Logs</h4>
                
                <!-- 🔍 Search Input -->
                <input type="text" class="form-control mb-2 search-input" id="adminSearchInput" style="width:250px;" placeholder="Search admin name...">
 
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
    max-height: 350px !important;
    overflow-y: auto !important;
}

.scrollable-tbody {
    display: block !important;
    overflow-y: auto !important;
}

.scrollable-tbody tr {
    display: table !important;
    width: 100% !important;
    table-layout: fixed !important;
}

.table thead,
.table tbody tr {
    width: 100% !important;
    display: table !important;
    table-layout: fixed !important;
}

.table thead {
    position: sticky !important;
    top: 0 !important;
    z-index: 2 !important;
    background-color: #f8f9fa !important;
}

.modal-content,
.modal-header,
.modal-body,
.modal-footer {
    background-color: #fff;
    color: #000;
}
.search-input {
    color: black !important;
    background-color: white !important;
    border: 1px solid #ccc;
}

.search-input:focus {
    background-color: white;
    color: black;
    border-color: gray;
    box-shadow: none;
}
</style>


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

    @include('admin.script')
</body>
</html>
