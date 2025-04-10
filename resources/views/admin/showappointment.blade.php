<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
          <div class="table-responsive">
            <table class="table table-bordered text-center w-100">
            <thead style="background-color: #AD1457;" class="text-white">
                <tr>
                  <th class="text-center text-white">Customer Name</th>
                  <th class="text-center text-white">Email</th>
                  <th class="text-center text-white" >Phone</th>
                  <th class="text-center text-white">Service</th>
                  <th class="text-center text-white">Date & Time</th>
                  <th class="text-center text-white">Message</th>
                  <th class="text-center text-white">Status</th>
                  <th class="text-center text-white">Action</th>
                </tr>
              </thead>

              <tbody>
                @foreach($data as $appoint)
                  <tr class="table-light">
                    <td class="text-center">{{ $appoint->user->name ?? $appoint->name }}</td>
                    <td class="text-center">{{ $appoint->user->email ?? $appoint->email }}</td>
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
                          case 'in progress':
                            $statusClass = 'bg-warning text-dark';
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
                          <a class="dropdown-item text-success" href="{{ url('approved', $appoint->id) }}" title="Approve">
                            <i class="fa fa-check"></i> Approved
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item text-danger" href="{{ url('canceled', $appoint->id) }}" title="Cancel">
                            <i class="fas fa-times"></i> Cancel
                          </a>
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

    @include('admin.script')

  </body>
</html>
