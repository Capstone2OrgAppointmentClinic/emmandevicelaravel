<!DOCTYPE html>
<html lang="en">
<head>
    
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
                    <h2 class="text-center" style="color: #333;">Manage Doctors</h2>
                    <a href="{{ url('add_doctor_view') }}" class="btn text-white" style="background-color: #AD1457;">Add Doctor</a>                    <table>
                        <thead>
                            <tr ">
                                <th class="bg-[#AD1457]">Doctor Name</th>
                                <th class="bg-[#AD1457]">Phone</th>
                                <th class="bg-[#AD1457]">Speciality</th>
                                <th class="bg-[#AD1457]">Image</th >
                                <th class="bg-[#AD1457]">Remove</th>
                                <th class="bg-[#AD1457]">Update</th>
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
                                    <a onclick="return confirm('Are you sure to remove this?')" class="btn btn-danger" href="{{ url('removedoctor', $doctor->id) }}">Remove</a>
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="{{ url('updatedoctor', $doctor->id) }}">Update</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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

    @include('admin.script')
</body>
</html>
