<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->

<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
        <th class="text-center">Customer Name</th>
        <th class="text-center">Email</th>
        <th class="text-center">Phone</th>
        <th class="text-center">Service</th>
        <th class="text-center">Date & Time</th>
        <th class="text-center">Message</th>
        <th class="text-center">Status</th>
        <th class="text-center">Action</th>
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
            <span class="badge 
                @if($appoint->status == 'approved') bg-success 
                @elseif($appoint->status == 'canceled') bg-danger 
                @elseif($appoint->status == 'in progress') bg-warning text-dark 
                @else bg-secondary 
                @endif">
                {{ ucfirst($appoint->status) }}
            </span>
        </td>

        <!-- Action Dropdown for Each Row -->
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


<!-- Style for Hover Dropdown -->
<style>
    .dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0;
    }

    .dropdown-menu li:hover,
    .dropdown-menu a.dropdown-item:hover {
        background-color: transparent !important;
        color: #ff00ff !important;
        transition: none !important;
        box-shadow: none !important;
    }
</style>


<!-- Style for Hover Dropdown -->
<style>
    .dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0;
    }

    .dropdown-menu li:hover,
    .dropdown-menu a.dropdown-item:hover {
        background-color: transparent !important;
        color: #ff00ff !important;
        transition: none !important;
        box-shadow: none !important;
    }
</style>


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