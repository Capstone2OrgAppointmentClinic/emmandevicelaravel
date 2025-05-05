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
      <div class="container-fluid w-100  mt-5" style="background-color: #FAEBD7;">
        <div class="mt-5">
          
@if(session('success'))
    <div class="position-fixed top-1 end-0 p-3" style="z-index: 9999;">
        <div id="autoDismissToast" class="toast align-items-center text-success bg-light border-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="1000">
            <div class="d-flex">
                <div class="toast-body" style="font-size:20px;">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    </div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toastEl = document.getElementById('autoDismissToast');
        const toast = new bootstrap.Toast(toastEl, { delay: 2000 });
        toast.show();
    });
</script>
@endif

          <div class="table-responsive">     
          <table class="table table-bordered text-center w-100 ">
          <x-input placeholder="Search records..." class="w-[270px] flex h-auto my-4 mt-5" id="searchInput" style=" color: black;"></x-input>
          <thead style="background-color: #AD1457;" class="text-white">
  <tr>
    <th id="nameHeader" class="text-center text-white" style="width: 150px; word-wrap: break-word; white-space: normal;">Customer Name</th>
    <th id="emailHeader" class="text-center text-white" style="width: 150px; word-wrap: break-word; white-space: normal;">Email</th>
    <th id="phoneHeader" class="text-center text-white" style="width: 150px; word-wrap: break-word; white-space: normal;">Phone</th>
    <th id="serviceHeader" class="text-center text-white" style="width: 150px; word-wrap: break-word; white-space: normal;">Service</th>
    <th id="dateHeader" class="text-center text-white" style="width: 150px; word-wrap: break-word; white-space: normal;">Date & Time</th>
    <th id="messageHeader" class="text-center text-white" style="width: 150px; word-wrap: break-word; white-space: normal;">Purpose</th>
    <th id="statusHeader" class="text-center text-white" style="width: 150px; word-wrap: break-word; white-space: normal;">Status</th>
    <th id="actionHeader" class="text-center text-white" style="width: 150px; word-wrap: break-word; white-space: normal;">Action</th>
  </tr>
</thead>
<script></script>


              <tbody>
                @foreach($data as $appoint)
                  <tr class="table-light">
                    <td class="text-center" style="width: auto; word-wrap: break-word; white-space: normal;">{{ $appoint->user->name ?? $appoint->name }}</td>
                    <td class="text-center" style="width: auto; word-wrap: break-word; white-space: normal;">{{ $appoint->user->email ?? $appoint->email }}</td>
                    <td class="text-center" style="width: auto; word-wrap: break-word; white-space: normal;" >{{ $appoint->phone }}</td>
                    <td class="text-center" style="width: auto; word-wrap: break-word; white-space: normal;">{{ $appoint->service }}</td>
                    <td class="text-center" style="width: auto; word-wrap: break-word; white-space: normal;">{{ $appoint->date }} {{ date('h:i A', strtotime($appoint->time)) }}</td>
                    <td class="text-center" style="width: auto; word-wrap: break-word; white-space: normal;">
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
                          case 'in process':
                            $statusClass = 'bg-secondary';
                            break;
                          case 'reschedule':
                            $statusClass = 'bg-primary';
                            break;
                          default:
                            $statusClass = 'bg-primary';
                            break;
                        }
                      @endphp

                      <span class="badge {{ $statusClass }}">
                        {{ ucfirst($appoint->status) }}
                      </span>
                    </td>

                    <td class="text-center dropdown">
                    @php
                    $status = strtolower($appoint->status);
                    @endphp

                  @if(in_array($status, ['pending', 'approved', 'reschedule', 'rescheduled', 'in process', 'done']))
                    <a class="btn btn-outline-dark dropdown-toggle w-100" href="#" role="button" id="rowActionDropdown{{ $appoint->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                      Choose
                    </a>
                    <ul class="dropdown-menu w-100" aria-labelledby="rowActionDropdown{{ $appoint->id }}">
                      @if(in_array($status, ['pending', 'reschedule', 'rescheduled']))
                      <li>
                        <button type="button" class="dropdown-item text-success open-approved-modal"
                            data-id="{{ $appoint->id }}"
                            data-email="{{ $appoint->user->email ?? $appoint->email }}"
                            data-name="{{ $appoint->user->name ?? $appoint->name }}">
                            <i class="fa fa-check"></i> approved
                          </button>
                        </li>
                        <li>
                        <button type="button" class="dropdown-item text-danger open-cancel-modal"
                            data-id="{{ $appoint->id }}"
                            data-email="{{ $appoint->user->email ?? $appoint->email }}"
                            data-name="{{ $appoint->user->name ?? $appoint->name }}">
                            <i class="fas fa-times"></i> Cancel
                          </button>
                        </li>
                      @endif
                      @if(in_array($status, ['pending', 'approved', 'reschedule', 'rescheduled']))
                        <li>
                          <a class="dropdown-item text-info" href="{{ url('process', $appoint->id) }}" title="In Process">
                            <i class="fas fa-spinner"></i> In Process
                          </a>
                        </li>
                      @endif
                      @if(in_array($status, ['pending', 'approved', 'reschedule', 'rescheduled', 'in process']))
                        <li>
                          <button type="button" class="dropdown-item text-success open-done-modal"
                            data-id="{{ $appoint->id }}"
                            data-email="{{ $appoint->user->email ?? $appoint->email }}"
                            data-name="{{ $appoint->user->name ?? $appoint->name }}">
                            <i class="fa-solid fa-circle-check"></i> Done
                          </button>
                        </li>
                      @endif
                      <li>
                        <a class="dropdown-item text-primary" href="{{ url('emailview', $appoint->id) }}" title="Send Email">
                          <i class="fas fa-envelope"></i> Send Mail
                        </a>
                      </li>
                    </ul>
                  @else
                    <span class="text-muted"></span>
                  @endif
                    </td>         
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

@include('admin.ModalDone')

@include('admin.modalCancel')

@include('admin.modalApproved')
      
<!-- Message Modal -->
      <div class="modal fade rounded-lg" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel">
        <div class="modal-dialog">
          <div class="modal-content" style="border-radius: 1rem 1rem 0 0; background-color:#FAEBD7 ;">
            <div class="modal-header w-full"  style="background-color: #AD1457; color: white; border-radius: 1rem 1rem 0 0;">
              <h5 class="modal-title flex justify-center w-full items-center text-[24px]" id="messageModalLabel"><i class="bi bi-calendar-check"></i>
              &nbsp;Purpose of Appointment</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
       
              </button>
            </div>
            <div class="modal-body flex justify-start  items-baseline" id="messageContent" style="margin-top: 20px; background-color: white; padding: 10px 50px 50px 50px; background: transparent;">
              <!-- Message will be dynamically updated here -->
            </div>
            <div class="modal-footer flex justify-center w-full items-center" style="background-color: #FAEBD7;">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="width: 150px; height: 30px; border-radius: 5px; background-color: #0090e7;">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <style>
  .modal-content {
    border: none !important;
  }

  .modal-header,
  .modal-body,
  .modal-footer {
    border: none !important;
  }
</style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        $("#modalUserName").text($(this).data("name"));
        $("#modalUserEmail").text($(this).data("email"));
        $("#modalUserPhone").text($(this).data("phone"));
        $("#modalUserAddress").text($(this).data("address"));
        $("#modalUserCourse").text($(this).data("course"));
        $("#modalStudentId").text($(this).data("student-id"));
        $("#modalEducation").text($(this).data("education"));
        $("#modalYear").text($(this).data("year"));
    });
</script>

<!-- Logs History Modal -->
<div class="modal fade" id="logsModal" tabindex="-1" aria-labelledby="logsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="max-width: 90%;">
        <div class="modal-content">
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
                <input type="text" class="form-control mb-2 search-input" style="width:250px;" id="studentSearchInput" placeholder="Search student name">
                      
                <div class="table-wrapper table-responsive">
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
        const nameCell = row.querySelector('td:nth-child(1)');
        const emailCell = row.querySelector('td:nth-child(2)');
        const phoneCell = row.querySelector('td:nth-child(3)');
        const serviceCell = row.querySelector('td:nth-child(4)');
        const dateCell = row.querySelector('td:nth-child(5)');
        const statusCell = row.querySelector('td:nth-child(7)');

        const nameText = nameCell ? nameCell.textContent.toLowerCase() : '';
        const emailText = emailCell ? emailCell.textContent.toLowerCase() : '';
        const phoneText = phoneCell ? phoneCell.textContent.toLowerCase() : '';
        const serviceText = serviceCell ? serviceCell.textContent.toLowerCase() : '';
        const dateText = dateCell ? dateCell.textContent.toLowerCase() : '';
        const statusText = statusCell ? statusCell.textContent.toLowerCase() : '';

        if (nameText.includes(filter) || phoneText.includes(filter) || dateText.includes(filter) || serviceText.includes (filter) ||  statusText.includes(filter) || emailText.includes(filter) ) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });
  });
</script>


<script src="admin/assets/js/off-canvas.js"></script>
<script src="admin/assets/js/hoverable-collapse.js"></script>
<script src="admin/assets/js/misc.js"></script>

  </body>
</html>
