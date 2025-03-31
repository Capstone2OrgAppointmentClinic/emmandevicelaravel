<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    @include('admin.script')
</head>
<body style="background-color: #FAEBD7;">
    <div class="container-scroller w-full">
        @include('admin.sidebar')
        @include('admin.navbar')

       

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="main-panel w-full">
         <div class="content-wrapper flex flex-col " style="background-color: #FAEBD7;">
     <div class="justify-center p-6 flex-wrap gap-4 md:flex-row md:items-center">

         <!-- Users Button Box -->
         <button id="toggleUsers" class="btn box-btn" style="height: auto; width: 260px; padding: 20px 30px; margin: 15px; background-color: #AD1457; color: white; border-radius: 15px; border: none; box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3); transition: all 0.3s ease;">
             <div class="btn-content" style="display: flex; align-items: center; justify-content: space-between;">
                 <i class="fas fa-user" style="font-size: 40px;"></i>
                 <div style="text-align: right;">
                     <h3 style="font-size: 24px; font-weight: 600; margin: 0;">Users</h3>
                     <p style="font-size: 32px; font-weight: 700; margin: 5px 0;">{{ count($users ?? []) }}</p>
                 </div>
             </div>
         </button>

         <!-- Appointment Button Box -->
         <button id="toggleAppointment" class="btn box-btn" style="height: auto; width: 260px; padding: 20px 30px; margin: 15px; background-color: #AD1457; color: white; border-radius: 15px; border: none; box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3); transition: all 0.3s ease;">
        <div class="btn-content" style="display: flex; align-items: center; justify-content: space-between;">
        <i class="fas fa-calendar-check" style="font-size: 40px;"></i>
        <div style="text-align: right;">
            <h3 style="font-size: 24px; font-weight: 600; margin: 0;">Appointment</h3>
            <p style="font-size: 32px; font-weight: 700; margin: 5px 0;">↓</p>
        </div>
        </div>
        </button>

         <!-- Availability Button Box -->
         <button id="toggleAvailability" class="btn box-btn" style="height: auto; width: 260px; padding: 20px 30px; margin: 15px; background-color: #AD1457; color: white; border-radius: 15px; border: none; box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3); transition: all 0.3s ease;">
             <div class="btn-content" style="display: flex; align-items: center; justify-content: space-between;">
                 <i class="fas fa-clock" style="font-size: 40px;"></i>
                 <div style="text-align: right;">
                     <h3 style="font-size: 24px; font-weight: 600; margin: 0;">Availability</h3>
                     <p style="font-size: 32px; font-weight: 700; margin: 5px 0;">↓</p>
                 </div>
             </div>
         </button>

         <!-- Equipment Button Box -->
         <button id="toggleEquipment" class="btn box-btn" style="height: auto; width: 260px; padding: 20px 30px; margin: 15px; background-color: #AD1457; color: white; border-radius: 15px; border: none; box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3); transition: all 0.3s ease;">
             <div class="btn-content" style="display: flex; align-items: center; justify-content: space-between;">
                 <i class="fas fa-toolbox" style="font-size: 40px;"></i>
                 <div style="text-align: right;">
                     <h3 style="font-size: 24px; font-weight: 600; margin: 0;">Equipment</h3>
                     <p style="font-size: 32px; font-weight: 700; margin: 5px 0;">↓</p>
                 </div>
             </div>
         </button>
         </div>
    @include('admin.buttoncss')
   
    <div id="userTable" style="display: none; margin-top: 20px;">
    <h3 style="margin-left: 12px; color: black;">User's Information</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Student ID</th>
                    <th>Year Level</th> 
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td style="color: #778899;">{{ $user->name }}</td>
                        <td style="color: #778899;">{{ $user->email }}</td>
                        <td style="color: #778899;">{{ $user->student_id }}</td>
                        <td style="color: #778899;">{{ $user->year_level }}</td>
                        <td>
                        <button class="btn btn-primary viewUser" 
                         data-name="{{ $user->name}}" 
                         data-email="{{ $user->email}}" 
                         data-phone="{{ $user->phone}}" 
                         data-address="{{ $user->address}}"
                         data-course="{{ $user->course}}" 
                         data-student-id="{{ $user->student_id}}"
                         data-education="{{ ucfirst($user->education_level)}}"
                         data-year="{{ $user->year_level}}"
                         data-bs-toggle="modal" data-bs-target="#viewUserModal">
                         View
                        </button>
                        <a href="{{ url('/editUser', $user->id) }}" class="btn btn-warning">Edit</a>
                        <a class="btn btn-danger" onclick="return confirm('are you sure to delete this')" href="{{url('deleteUser',$user->id)}}">Delete</a>
                        </td>
                    </tr>
                  @endforeach
               </tbody>
            </table>
         </div>

        <script>
        document.getElementById('toggleUsers').addEventListener('click', function() {
        let userTable = document.getElementById('userTable');
        let userCount = this.getAttribute('data-user-count')

        if (userTable.style.display === 'none') {
            userTable.style.display = 'block';
          
        } else {
            userTable.style.display = 'none';
           
        }
    });
    </script>

  <div class="modal fade" id="viewUserModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User Info</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <span id="modalUserName"></span></p>
                <p><strong>Email:</strong> <span id="modalUserEmail"></span></p>
                <p><strong>Phone:</strong> <span id="modalUserPhone"></span></p>
                <p><strong>Address:</strong> <span id="modalUserAddress"></span></p>
                <p><strong>Course:</strong> <span id="modalUserCourse"></span></p>
                <p><strong>Student ID:</strong> <span id="modalStudentId"></span></p>
                <p><strong>Education Level:</strong> <span id="modalEducation"></span></p>
                <p><strong>Year Level:</strong> <span id="modalYear"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    
</body>
</html>
