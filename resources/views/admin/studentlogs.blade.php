<!DOCTYPE html>
<html lang="en">

<head>

<link rel="icon" href="{{ asset('assets/img/adminimg/titlebaricon.ico') }}" type=" image/icon">
    @include('admin.css')
    @include('admin.announcecss')

    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-bottom: 40px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        border-radius: 12px;
        overflow: hidden;
    }

    th, td {
        padding: 14px 20px;
        text-align: left;
        background-color: #ffffff;
    }

    th {
        background-color: #f1f5f9;
        font-weight: 600;
        color: #374151;
    }

    tr:not(:last-child) td {
        border-bottom: 1px solid #e5e7eb;
    }

    tr:hover td {
        background-color: #f9fafb;
    }

    h2, h4 {
        color: #1f2937;
        font-weight: 600;
        margin-top: 25px;
    }

    .container {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        margin-top: 40px;
    }

    .table-section {
        margin-top: 40px;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }
</style>

</head>

<body style="background-color: #FAEBD7;">
    <div class="container-scroller">
        @include('admin.sidebar')
        @include('admin.navbar')

        <div class="container-fluid w-100 p-5">
<div class="container">
    <h2 class="mb-4">Logs History</h2>
    
    <!-- Student Logs Table -->
    <h4>Student Logs</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Login Time</th>
                <th>Logout Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                @if($log->student && $log->student->usertype == 0)
                    <tr>
                        <td>{{ $log->student->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($log->login_at)->format('Y-m-d h:i A') }}</td>
                        <td>{{ $log->logout_at ? \Carbon\Carbon::parse($log->logout_at)->format('Y-m-d h:i A') : '—' }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <!-- Admin Logs Table -->
    <h4 style=" margin-top: 60px;">Admin Logs</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Admin Name</th>
                <th>Login Time</th>
                <th>Logout Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                @if($log->student && $log->student->usertype != 0)
                    <tr>
                        <td>{{ $log->student->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($log->login_at)->format('Y-m-d h:i A') }}</td>
                        <td>{{ $log->logout_at ? \Carbon\Carbon::parse($log->logout_at)->format('Y-m-d h:i A') : '—' }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    {{ $logs->links() }}
</div>
@include('admin.script')
    </div>
</body>

</html>