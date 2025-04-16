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