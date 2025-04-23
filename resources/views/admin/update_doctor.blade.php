<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    
    @include('admin.css')

    <style>
        body {
            background-color: #F5F5F5;
            font-family: 'Arial', sans-serif;
        }

        .form-container {
            margin-top: 80px;
            padding: 40px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 50%;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            display: block;
        }

        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
        }

        input[type="text"]:focus, input[type="file"]:focus {
            border-color: #00D9A5;
            box-shadow: 0 0 5px rgba(0, 217, 165, 0.5);
        }

        .image-container {
            margin-top: 10px;
            text-align: center;
        }

        img {
            border-radius: 10px;
            border: 2px solid #ddd;
            transition: transform 0.3s ease-in-out;
        }

        img:hover {
            transform: scale(1.05);
        }

        .btn-primary {
            background-color: #00D9A5;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #00B08C;
            box-shadow: 0 4px 8px rgba(0, 217, 165, 0.2);
        }

        .alert-success {
            background-color: #D4EDDA;
            color: #155724;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .close {
            float: right;
            font-size: 18px;
            cursor: pointer;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-container {
                width: 90%;
                padding: 20px;
            }

            input[type="text"], input[type="file"], .btn-primary {
                font-size: 14px;
                padding: 10px;
            }
        
    </style>
</head>
<body style="background-color: #FAEBD7;">
    <div class="container-scroller">
        <!-- Sidebar -->
        @include('admin.sidebar')

        <!-- Navbar -->
        @include('admin.navbar')

        <!-- Main Content -->
        <div class="container-fluid page-body-wrapper">
            <div class="container d-flex justify-content-center">
                <div class="form-container">
                <h2 class="text-center" style="color: #333; margin-bottom: 30px; font-size: 20px; font-weight: 600;">
                Update Doctor Details
                </h2>


                    <!-- Success Message -->
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session()->get('message') }}
                    </div>
                    @endif

                    <!-- Form Section -->
                    <form action="{{ url('editdoctor', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Doctor Name -->
                        <div class="form-group">
                            <label>Doctor Name</label>
                            <input style="color: #333; font-weight: 500;" type="text" name="name" value="{{ $data->name }}" required>
                        </div>

                        <!-- Phone -->
                        <div class="form-group">
                            <label>Phone</label>
                            <input style="color: #333; font-weight: 500;" type="text" name="phone" value="{{ $data->phone }}" required>
                        </div>

                
                        <!-- Current Image -->
                        <div class="form-group image-container">
                            <label>Current Image</label><br>
                            <img height="150" width="150" src="doctorimage/{{ $data->image }}" alt="Doctor Image">
                        </div>

                        <!-- Upload New Image -->
                        <div class="form-group">
                            <label>Change Image</label>
                            <input style="color: #333; font-weight: 500;" type="file" name="file">
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Update Details">
                        </div>
                    </form>
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

</body>
</html>
