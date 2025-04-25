<!DOCTYPE html>
<html lang="en">

<head>
<link rel="icon" href="{{ asset('assets/img/adminimg/titlebaricon.ico') }}" type=" image/icon">
    @include('admin.css')
    @include('admin.announcecss')

    <style>
        .form-control[type="date"] {
            font-size: 16px;
            padding: 12px;
            background-color: #f1f1f1;
            border-radius: 5px;
            color: black;
            border: 2px solid #AD1457;
        }
        .form-control {
            font-size: 16px;
            padding: 12px;
            background-color: #f1f1f1;
            border-radius: 5px;
            color: black;
        }
        select.form-control {
            color: black;
            border: 2px solid #AD1457;
            font-size: 16px;
            width: 100%;
        }

        select.form-control:focus {
            border-color: #9C1145;
            outline: none;
        }
        .card {
            margin-top: 0px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .mb-4 {
            margin-bottom: 20px;
        }
        .btn-submit {
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #AD1457;
            color: white;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #9C1145;
        }
        .container-wrapper {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            margin-top: 80px;
        }
    </style>
</head>

<body style="background-color: #FAEBD7;">
    
    <div class="container-scroller" style="background-color: #FAEBD7;">
        @include('admin.sidebar')
        @include('admin.navbar')

        <!-- Content Wrapper -->
        <div class="container container-wrapper">
            <!-- Announcement Card -->
            <div class="card">

            <div class="mb-4 mt-4">
                <a style="color: white; background-color: #AD1457; padding: 10px; border-radius: 5px; margin-bottom: 1rem; font-weight: bold;; " href="{{ route('viewAnnouncements') }}">View Announcement</a>
            </div>
                <div class="card-header rounded-lg">
                    Create Announcement
                </div>
                <div class="card-body">
                    <!-- Show success message -->
                  

                    <!-- Show errors if validation fails -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Announcement Form -->
                    <form action="{{ url('createAnnouncement') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Title Field -->
                        <div class="mb-4">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Announcement Title" required>
                        </div>

                        <!-- Message Field -->
                        <div class="mb-4">
                            <label for="message">Message</label>

                            <textarea class="form-control" name="message" rows="5" placeholder="Enter Announcement Message" required></textarea>
                        </div>

                         <!-- Announcement Type -->
                        <div class="mb-4">
                            <label for="type">Announcement</label>
                            <select class="form-control" name="type" required>
                            <option value="" disabled selected>-- Select Type --</option>
                            <option value="Announcement">Announcement</option>
                            <option value="Suspension">Suspension</option>
                            <option value="Notice: Clinic Closed">Notice: Clinic Closed</option>
                            <option value="Announcement">School Activity</option>
                            <option value="School Event">School Event</option>
                            <option value="Holiday">Holiday</option>
                            <option value="Special Holiday">Special Holiday</option>
                         </select>
                        </div>

                         <!-- Expired Date -->
                         <div class="mb-4">
                            <label for="expired_date">Expired Date</label>
                            <input type="date" class="form-control" name="expired_date" required>
                         </div>

                        <!-- Image Upload Field -->
                        <div class="mb-4">
                            <label for="image">Image Announcement</label>
                            <input type="file" class="custom-file-input" name="image" accept="image/*">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-submit">Send Announcement</button>
                    </form>
                </div>
            </div>
        </div>

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
        
    </div>
</body>

</html>
