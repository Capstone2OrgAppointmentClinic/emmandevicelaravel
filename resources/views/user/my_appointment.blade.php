<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>CliniQuickAid</title>

  <link rel="stylesheet" href="../assets/css/maicons.css">

  <link rel="stylesheet" href="../assets/css/bootstrap.css">

  <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">

  <link rel="stylesheet" href="../assets/vendor/animate/animate.css">

  <link rel="stylesheet" href="../assets/css/theme.css">

</head>
<body>
  <div class="back-to-top"></div>

  <header>
    


    <nav class="navbar navbar-expand-lg navbar-light shadow-sm bg-light">
      <div class="container">
      <img src="../assets/img/person/svfctrans.png" alt="logo " style="width:auto; height: 60px;"/>
        <a class="navbar-brand" href="home"><span class="text-primary"><span style="color:#f204f2;">Clini</span></span>-QuickAid</a>
        

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{url('/')}}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="doctors.html">Doctors</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('announcement')}}">Announcements</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact</a>
            </li>
            
            @if(Route::has('login'))

            @auth

            <li class="nav-item">
             <a class="nav-link" href="{{url('myappointment')}}">My Appointment</a>
            </li>


            <x-app-layout>
            </x-app-layout>

            @else
            
            
            <li class="nav-item">
              <a class="btn btn-primary ml-lg-3" href="{{route('login')}}">Login</a>
            </li>

            
            
            <li class="nav-item">
              <a class="btn btn-primary ml-lg-3" href="{{route('register')}}">Register</a>
            </li>

            @endauth

            
            @endif
         
        
        </ul>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>

  @if(session('message'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


  <div align="center" style="padding: 70px;">
    <h1 style="font-size: 40px; padding: 15px;  color: #000; font-weight: bold;">
        Appointment Schedule
    </h1>

        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped mt-4 shadow-lg" style="width: 100%; max-width: 1000px; border-radius: 12px; overflow: hidden;">
                <thead class="bg-success text-white">
                    <tr>
                        <th style="padding: 12px; font-size: 20px;">Service</th>
                        <th style="padding: 12px; font-size: 20px;">Date</th>
                        <th style="padding: 12px; font-size: 20px;">Time</th>
                        <th style="padding: 12px; font-size: 20px;">Message</th>
                        <th style="padding: 12px; font-size: 20px;">Status</th>
                        <th style="padding: 12px; font-size: 20px;">Cancel</th>
                        <th style="padding: 12px; font-size: 20px;">Reschedule</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appoint as $appoints)
                    <tr class="align-middle">
                    <td style="padding: 12px; font-size: 18px; color: #333;">{{$appoints->service}}</td>
                    <td style="padding: 12px; font-size: 18px; color: #333;">{{$appoints->date}}</td>
                    <td style="padding: 12px; font-size: 18px; color: #333;">
                     {{ date('h:i A', strtotime($appoints->time)) }}
                    </td>
                        <td style="padding: 12px; font-size: 18px; color: #333;">{{$appoints->message}}</td>
                        <td style="padding: 12px; font-size: 18px;">
                    @php
                    $status = strtolower(trim($appoints->status));
                    @endphp

                    @if($status == 'in progress')
                    <span class="badge bg-warning text-dark" style="font-size: 14px;">{{ ucfirst($appoints->status) }}</span>
                    @elseif($status == 'approved')
                    <span class="badge bg-success" style="font-size: 14px;">{{ ucfirst($appoints->status) }}</span>
                    @elseif($status == 'canceled')
                    <span class="badge bg-danger" style="font-size: 14px;">{{ ucfirst($appoints->status) }}</span>
                    @else
                    <span class="badge bg-secondary" style="font-size: 14px;">{{ ucfirst($appoints->status) }}</span>
                    @endif
                    @if($status == 'approved' || $status == 'canceled')
                     <td></td>
                     <td></td>
                    @else
                      <td>
                    <button class="btn btn-danger btn-sm" onclick="showCancelReasonModal({{ $appoints->id }})"
                     style="padding: 6px 12px; font-size: 14px;">
                        Cancel
                    </button>
                     </td>
                      <td>
                    <button class="btn btn-primary btn-sm" onclick="showRescheduleModal({{ $appoints->id }})"
                       style="padding: 6px 12px; font-size: 14px;">
                        Reschedule
                      </button>
                      </td>
                       @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Reschedule Modal -->
<div class="modal fade" id="rescheduleModal" tabindex="-1" aria-labelledby="rescheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="rescheduleForm" method="POST" action="{{ url('reschedule_appoint') }}">
            @csrf
            <input type="hidden" name="appointment_id" id="reschedule_appointment_id">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="rescheduleModalLabel">Reschedule Appointment</h5>
                    <button type="button" onclick="closeRescheduleModal()" aria-label="Close" 
                            style="font-size: 30px; background: none; border: none; color: red; outline: none; box-shadow: none;">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="reschedule_reason" class="form-label">Why do you want to reschedule?</label>
                        <textarea class="form-control" id="reschedule_reason" name="reschedule_reason" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="reschedule_date" class="form-label">Select New Date</label>
                        <input type="date" class="form-control" id="reschedule_date" name="reschedule_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="reschedule_time" class="form-label">Select New Time</label>
                        <input type="time" class="form-control" id="reschedule_time" name="reschedule_time" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Reschedule</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Cancel Reason Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="cancelModalLabel" style="flex-grow: 1; text-align: center;">Reason for Cancellation</h5>
                <button type="button" onclick="closeModal()" aria-label="Close" 
                style="font-size: 30px; background: none; border: none; color: white; outline: none; box-shadow: none;">
                &times;
                </button>
            </div>

            <form id="cancelForm" action="{{ url('cancel_appoint') }}" method="POST">
                @csrf
                <input type="hidden" name="appointment_id" id="appointment_id">

                <div class="modal-body">
                    <label for="cancel_reason" style="font-size: 14px;" align="center;" class="form-label">Leave a message below for cancellation of this appointment:</label>
                    <textarea name="cancel_reason" id="cancel_reason" class="form-control" rows="4" placeholder="Enter your reason..." required></textarea>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showRescheduleModal(appointmentId) {
        document.getElementById('reschedule_appointment_id').value = appointmentId;
        var rescheduleModal = new bootstrap.Modal(document.getElementById('rescheduleModal'));
        rescheduleModal.show();

        window.currentCancelModal = rescheduleModal;
    }

    function showCancelReasonModal(appointmentId) {
        document.getElementById("appointment_id").value = appointmentId;
        var cancelModal = new bootstrap.Modal(document.getElementById('cancelModal'));
        cancelModal.show();
        
        window.currentCancelModal = cancelModal;
    }

    function closeRescheduleModal() {
        if (window.currentCancelModal) {
            window.currentCancelModal.hide();
        }
    }

    function closeModal() {
        if (window.currentCancelModal) {
            window.currentCancelModal.hide();
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
    const rescheduleDateInput = document.getElementById('reschedule_date');
    const rescheduleTimeInput = document.getElementById('reschedule_time');
    const rescheduleButton = document.querySelector("button[type='submit']");

    const today = new Date().toISOString().split('T')[0];
    rescheduleDateInput.setAttribute('min', today);

    rescheduleButton.disabled = true;

    rescheduleDateInput.addEventListener('change', checkTimeConflict);
    rescheduleTimeInput.addEventListener('change', checkTimeConflict);

    function checkTimeConflict() {
        const appointmentId = document.getElementById('reschedule_appointment_id').value;
        const rescheduleDate = rescheduleDateInput.value;
        const rescheduleTime = rescheduleTimeInput.value;

        if (rescheduleDate && rescheduleTime) {
            fetch(`/check-conflict/${appointmentId}/${rescheduleDate}/${rescheduleTime}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error checking conflicts');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.appointmentLimit) {
                        alert('The daily limit of 5 appointments has already been reached for this date. Please choose another date.');
                        rescheduleButton.disabled = true;
                    } else if (data.exactConflict) {
                        alert('An appointment is already scheduled for the same date and time. Please choose another time.');
                        rescheduleButton.disabled = true;
                    } else if (data.timeConflict) {
                        alert('Another appointment is scheduled within 1 hour of the selected time. Please choose another time.');
                        rescheduleButton.disabled = true;
                    } else {
                        rescheduleButton.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error checking for conflicts. Please try again.');
                    rescheduleButton.disabled = true;
                });
        } else {
            rescheduleButton.disabled = true;
        }
    }
    let alertDiv = document.querySelector('.alert');
    if (alertDiv) {
        setTimeout(function () {
            alertDiv.style.display = 'none';
        }, 5000);
    }
});
</script>




<script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../assets/vendor/wow/wow.min.js"></script>

<script src="../assets/js/theme.js"></script>

</body>
@include('user.calendar')
</html>