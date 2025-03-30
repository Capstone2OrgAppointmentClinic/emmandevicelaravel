<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->

    
    @include('admin.css')

  </head>
  <body style="background-color: #FAEBD7;">
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="">
            <div class="ps-lg-1">
              <div class="d-flex align-items-center justify-content-between">
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- partial:partials/_sidebar.html -->
 
      @include('admin.sidebar')

      <!-- partial -->
     
       @include('admin.navbar')

        <!-- partial -->
      
       <div class="container-fluid w-100 p-5">
       <div class="table-responsive w-100 p-4 rounded shadow;">
            <h1 class="text-center text-dark py-3 fw-bold;">Appointments</h1>
            <table class="table table-bordered text-center w-100">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Service</th>
                        <th>Date & Time</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Approve</th>
                        <th>Cancel</th>
                        <th>Send Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $appoint)
                    <tr class="table-light">
                        <td>{{ $appoint->user->name ?? $appoint->name }}</td>
                        <td>{{ $appoint->user->email ?? $appoint->email }}</td>
                        <td>{{ $appoint->phone }}</td>
                        <td>{{ $appoint->service }}</td>
                        <td>{{ $appoint->date }} {{ date('h:i A', strtotime($appoint->time)) }}</td>
                        <td>
                            <button class="btn btn-outline-primary view-message" data-id="{{ $appoint->id }}" data-message="{{ $appoint->message }}">
                                View
                            </button>
                        </td>
                        <td>
                            @php
                                $status = strtolower(trim($appoint->status));
                                $statusClass = match($status) {
                                    'approved' => 'badge bg-success',
                                    'canceled' => 'badge bg-danger',
                                    'in progress' => 'badge bg-warning text-dark',
                                    default => 'badge bg-secondary'
                                };
                            @endphp
                            <span class="{{ $statusClass }}">{{ ucfirst($appoint->status) }}</span>
                        </td>
                        <td>
                            <a class="btn btn-outline-success w-100" href="{{ url('approved', $appoint->id) }}">Approve</a>
                        </td>
                        <td>
                            <a class="btn btn-outline-danger w-100" href="{{ url('canceled', $appoint->id) }}">Cancel</a>
                        </td>
                        <td>
                            <a class="btn btn-outline-primary w-100" href="{{ url('emailview', $appoint->id) }}">Send Email</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
</div>

@include('admin.script')


    <!-- End custom js for this page -->
  </body>
</html>