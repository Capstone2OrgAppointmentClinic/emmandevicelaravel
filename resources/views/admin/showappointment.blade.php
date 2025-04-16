<!DOCTYPE html>
<html lang="en">
  <head>
  <link rel="icon" href="{{ asset('assets/img/adminimg/titlebaricon.ico') }}" type=" image/icon">
    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @include('admin.css')

  </head>
  <body style="background-color: #FAEBD7;">
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-12 p-0 m-0">
          <div class="ps-lg-1">
            <div class="d-flex align-items-center justify-content-between"></div>
          </div>
          <div class="d-flex align-items-center justify-content-between"></div>
        </div>
      </div>

      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.navbar')

      <!-- partial -->
      <div class="container-fluid w-100 p-5">
        <div class="mt-5">
          <h1 class="text-center text-dark py-3 fw-bold" style="font-size: 2rem; margin: 25px;">Appointments</h1>

@if(session('success'))
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
        <div id="autoDismissToast" class="toast align-items-center text-white bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toastEl = document.getElementById('autoDismissToast');
        const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
        toast.show();
    });
</script>
@endif
          <div class="mb-3">
              <input type="text" id="searchInput" style="background-color: white; color: black; border: 2px solid #AD1457; width:200px; "class="form-control" placeholder="Search appointments...">
          </div>
          <div class="table-responsive">     
          <table class="table table-bordered text-center w-100">
          <thead style="background-color: #AD1457;" class="text-white">
                <tr>
                  <th class="text-center text-white" style="width: 150px; word-wrap: break-word; white-space: normal;" >Customer Name</th>
                  <th class="text-center text-white" style="width: 150px; word-wrap: break-word; white-space: normal;" >Email</th>
                  <th class="text-center text-white" style="width: 150px; word-wrap: break-word; white-space: normal;" >Phone</th>
                  <th class="text-center text-white" style="width: 150px; word-wrap: break-word; white-space: normal;">Service</th>
                  <th class="text-center text-white" style="width: 150px; word-wrap: break-word; white-space: normal;">Date & Time</th>
                  <th class="text-center text-white" style="width: 150px; word-wrap: break-word; white-space: normal;">Message</th>
                  <th class="text-center text-white" style="width: 150px; word-wrap: break-word; white-space: normal;">Status</th>
                  <th class="text-center text-white" style="width: 150px; word-wrap: break-word; white-space: normal;">Action</th>
                </tr>
              </thead>

              <tbody>
                @foreach($data as $appoint)
                  <tr class="table-light">
                    <td class="text-center" style="width: 150px; word-wrap: break-word; white-space: normal;">{{ $appoint->user->name ?? $appoint->name }}</td>
                    <td class="text-center" style="width: 150px; word-wrap: break-word; white-space: normal;">{{ $appoint->user->email ?? $appoint->email }}</td>
                    <td class="text-center">{{ $appoint->phone }}</td>
                    <td class="text-center">{{ $appoint->service }}</td>
                    <td class="text-center">{{ $appoint->date }} {{ date('h:i A', strtotime($appoint->time)) }}</td>
                    <td class="text-center">
                      <button class="btn btn-outline-primary view-message" data-id="{{ $appoint->id }}" data-message="{{ $appoint->message }}">
                        View
                      </button>
                    </td>

                    <!-- Status Column -->
                    <td class="text-center">
                      @php
                        $statusClass = '';
                        switch(strtolower($appoint->status)) {
                          case 'approved':
                            $statusClass = 'bg-success';
                            break;
                          case 'canceled':
                            $statusClass = 'bg-danger';
                            break;
                          case 'pending':
                            $statusClass = 'bg-warning text-dark';
                            break;
                          case 'done':
                            $statusClass = 'bg-info text-white';
                            break;
                          case 'rescheduled':
                            $statusClass = 'bg-primary';
                            break;
                          default:
                            $statusClass = 'bg-secondary';
                            break;
                        }
                      @endphp

                      <span class="badge {{ $statusClass }}">
                        {{ ucfirst($appoint->status) }}
                      </span>
                    </td>

                    <td class="text-center dropdown">
                      <a class="btn btn-outline-dark dropdown-toggle w-100" href="#" role="button" id="rowActionDropdown{{ $appoint->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                        Choose
                      </a>
                      <ul class="dropdown-menu w-100" aria-labelledby="rowActionDropdown{{ $appoint->id }}">
                        <li>
                          <a class="dropdown-item text-success" href="{{ url('approved', $appoint->id) }}" title="Approved">
                            <i class="fa fa-check"></i> Approved
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item text-danger" href="{{ url('canceled', $appoint->id) }}" title="Cancel">
                            <i class="fas fa-times"></i> Cancel
                          </a>
                        </li>
                        <li>
                         <button type="button" class="dropdown-item text-success open-done-modal"
                          data-id="{{ $appoint->id }}"
                          data-email="{{ $appoint->user->email ?? $appoint->email }}"
                          data-name="{{ $appoint->user->name ?? $appoint->name }}">
                         <i class="fa-solid fa-circle-check"></i> Done
                         </button>
                       </li>
                        <li>
                          <a class="dropdown-item text-primary" href="{{ url('emailview', $appoint->id) }}" title="Send Email">
                            <i class="fas fa-envelope"></i> Send Mail
                          </a>
                        </li>
                      </ul>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
<!-- Done Modal -->
<div class="modal fade" id="doneModal" tabindex="-1" aria-labelledby="doneModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ url('send-done-email') }}">
      @csrf
      <input type="hidden" name="appointment_id" id="doneAppointmentId">
      <input type="hidden" name="email" id="doneAppointmentEmail">

      <div class="modal-content">
        <div class="modal-header" style="background-color: #AD1457; color: white;">
          <h5 class="modal-title" id="doneModalLabel">Send Message</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="doneMessage" class="form-label">Message</label>
            <textarea class="form-control" name="message"style=" height:250px;" id="doneMessage" rows="4" required></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Send</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
  <style>
  #doneMessage {
    background-color: white;
    color: black;
    border: 2px solid #AD1457;
  }
</style>
<script>
  document.querySelectorAll('.open-done-modal').forEach(button => {
    button.addEventListener('click', () => {
      const id = button.getAttribute('data-id');
      const email = button.getAttribute('data-email');
      const modal = new bootstrap.Modal(document.getElementById('doneModal'));

      document.getElementById('doneAppointmentId').value = id;
      document.getElementById('doneAppointmentEmail').value = email;

      modal.show();
    });
  });
</script>
      <!-- Message Modal -->
      <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="messageModalLabel">Message</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="messageContent">
              <!-- Message will be dynamically updated here -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
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

  </body>
</html>
