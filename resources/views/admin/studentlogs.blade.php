<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="{{ asset('assets/img/adminimg/titlebaricon.ico') }}" type="image/icon">
    @include('admin.css')
    @include('admin.announcecss')

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }

        h2, h4 {
            color: #1f2937;
            font-weight: 600;
        }

        .container,
        .container-fluid {
            max-width: 100% !important;
            padding: 0;
            margin: 0;
            background: transparent;
            box-shadow: none !important;
            border-radius: 0 !important;
        }

        .table-section {
            margin-top: 40px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        th,
        td {
            padding: 14px 20px;
            text-align: left;
            background-color: #ffffff;
        }

        /* truncate long text in all cells */
        td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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

        .table thead th {
            background-color: #f8f9fa;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .search-input {
            color: #fff;
            background-color: #AD1457;
            border: none;
            border-radius: 12px;
            padding: 8px 16px;
            font-weight: 500;
        }

        .search-input::placeholder {
            color: #ffe6ec;
        }

        .search-input:focus {
            background-color: #AD1457;
            color: #fff;
            box-shadow: none;
            outline: none;
        }

        .mark {
            background-color: yellow;
            padding: 0 2px;
            border-radius: 3px;
        }

        .nav-tabs .nav-link.active {
            background-color: #AD1457;
            color: white;
            border: none;
            border-radius: 8px 8px 0 0;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #AD1457;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        @include('admin.sidebar')
        @include('admin.navbar')

        <div class="container-fluid mt-5">
            <div class="w-100">
                <h2 class="mb-4">Logs History</h2>

                <!-- Tabs -->
                <ul class="nav nav-tabs card-header-tabs w-full" id="logTabs" role="tablist" style="display: flex; align-items: stretch; width: 100%;">
                    <li class="nav-item">
                        <a class="nav-link active" id="student-tab" data-bs-toggle="tab" href="#studentLogsSection" role="tab" style="width: 86.5vh;">Student Logs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="admin-tab" data-bs-toggle="tab" href="#adminLogsSection" role="tab" style="width: 86.5vh;">Admin Logs</a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3">
                    <!-- Student Logs Section -->
                    <div class="tab-pane fade show active" id="studentLogsSection" role="tabpanel">
                        <input type="text" class="form-control mb-3 search-input rounded-lg border bg-gray-100 py-4" style="width:250px;" id="studentSearchInput" placeholder="Search student name...">

                        <div class="table-wrapper rounded-lg sty">
                            <table class="mb-0">
                                <colgroup>
                                    <col style="width: 20%;">
                                    <col style="width: 20%;">
                                    <col style="width: 20%;">
                                    <col style="width: 20%;">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th style="background-color: #AD1457; color: white;">Student Name</th>
                                        <th style="background-color: #AD1457; color: white;">Login Time</th>
                                        <th style="background-color: #AD1457; color: white;">Logout Time</th>
                                        <th style="background-color: #AD1457; color: white;">Device Used for Login</th>
                
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($logs->where('student.usertype', 0) as $log)
    <tr>
        <td style="background-color: gray;">{{ $log->student->name }}</td>
        <td style="background-color: gray;">{{ \Carbon\Carbon::parse($log->login_at)->format('Y-m-d h:i A') }}</td>
        <td style="background-color: gray;">{{ $log->logout_at ? \Carbon\Carbon::parse($log->logout_at)->format('Y-m-d h:i A') : '—' }}</td>
        <td style="background-color: gray;" title="{{ $log->device }}">{{ $log->device ?? 'Unknown' }}</td>
       
    </tr>
    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Admin Logs Section -->
                    <div class="tab-pane fade" id="adminLogsSection" role="tabpanel">
                        <input type="text" class="form-control mb-3 search-input rounded-lg border bg-gray-100 py-4" style="width:250px;" id="adminSearchInput" placeholder="Search admin name...">

                        <div class="table-wrapper rounded-lg">
                            <table class="mb-0">
                                <colgroup>
                                    <col style="width: 20%;">
                                    <col style="width: 20%;">
                                    <col style="width: 20%;">
                                    <col style="width: 20%;">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th style="background-color: #AD1457; color: white;">Admin Name</th>
                                        <th style="background-color: #AD1457; color: white;">Login Time</th>
                                        <th style="background-color: #AD1457; color: white;">Logout Time</th>
                                        <th style="background-color: #AD1457; color: white;">Device Used for Login</th>
                                    
                                    </tr>
                                </thead>
                                <tbody style="background-color: gray; border-radius: 50%;">
                                    @foreach($logs->where('student.usertype', '!=', 0) as $log)
                                    <tr>
                                        <td style="background-color: gray;">{{ $log->student->name }}</td>
                                        <td style="background-color: gray;">{{ \Carbon\Carbon::parse($log->login_at)->format('Y-m-d h:i A') }}</td>
                                        <td style="background-color: gray;">{{ $log->logout_at ? \Carbon\Carbon::parse($log->logout_at)->format('Y-m-d h:i A') : '—' }}</td>
                                        <td style="background-color: gray;" title="{{ $log->device }}">{{ $log->device ?? 'Unknown' }}</td>
                                      

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="logsModal" tabindex="-1" aria-labelledby="logsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" style="max-width: 90%;">
                    <div class="modal-content">
                        <div class="modal-header d-flex justify-content-between align-items-center">
                            <h5 class="modal-title" id="logsModalLabel">Logs History</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Content is already displayed above -->
                        </div>
                    </div>
                </div>
            </div>

            <script>
    function addSearchFunctionality(inputId, sectionId) {
        const input = document.getElementById(inputId);
        input.addEventListener("input", function () {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll(`#${sectionId} table tbody tr`);

            rows.forEach(row => {
                const nameCell = row.querySelector("td");
                if (nameCell) {
                    const text = nameCell.textContent.toLowerCase();
                    if (text.includes(filter)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                }
            });
        });
    }

    document.addEventListener("DOMContentLoaded", () => {
        addSearchFunctionality("studentSearchInput", "studentLogsSection");
        addSearchFunctionality("adminSearchInput", "adminLogsSection");
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
        </div>
    </div>

    @include('admin.script')
</body>

</html>