<!DOCTYPE html>
<html lang="en">
<head>
    
     <base href="/public">

     <style type="text/css">

    label
    {
      display: inline:block;
      
      width: 100px;

      

    }
    </style>
    
     @include('admin.css')
</head>
<body>
     <div class="container-scroller">
        @include('admin.sidebar')
        @include('admin.navbar')
        

        <div class="main-panel">
            <div class="content-wrapper" style="background-color: #FAEBD7;">
            <div class="container" align="center" style="padding-top:100px;">

                <form action="{{ url('/updateUser', $user->id) }}" method="POST">
                    @csrf

                    @if(session()->has('message'))

                    <div class="alert alert-success">

                     <button type="button" class="close" data-dismiss="alert"></button>

                    {{session()->get('message')}}

                     </div>
   
                     @endif

                    <div style="padding:15px;">
                        <label>Name</label>
                        <input style="color:black; width: 40%;" type="text" name="name" value="{{ $user->name }}" required>
                    </div>

                    <div style="padding:15px;">
                        <label>Email</label>
                        <input style="color:black; width: 40%;" type="email" name="email" value="{{ $user->email }}" required>
                    </div>

                    <div style="padding:15px;">
                        <label>Phone</label>
                        <input style="color:black; width: 40%;" type="text" name="phone" value="{{ $user->phone }}">
                    </div>

                    <div style="padding:15px;">
                        <label>Address</label>
                        <input style="color:black; width: 40%;" type="text" name="address" value="{{ $user->address }}">
                    </div>
                    
                    <div style="padding:15px color: #FAEBD7;">
                        <label>Course</label>
                        <input style="color:black; width: 40%;" type="text" name="course" value="{{ $user->course }}">
                    </div>

                    <div style="padding:15px;">
                        <label>Student ID</label>
                        <input style="color:black; width: 40%;" type="text" name="student_id" value="{{ $user->student_id }}">
                    </div>

                    <div>
                    <label for="education_level">Education Level</label>
                    <select name="education_level" style="color:black;" required>
                    <option value="college" {{ $user->education_level == 'college' ? 'selected' : '' }}>College</option>
                     <option value="junior_high" {{ $user->education_level == 'junior_high' ? 'selected' : '' }}>Junior School</option>
                     <option value="senior_high" {{ $user->education_level == 'senior_high' ? 'selected' : '' }}>Senior School</option>
                    </select>
                     </div>

                    <div style="padding:15px;">
                        <label>Year Level</label>
                        <input style="color:black;" type="text" name="year_level" value="{{ $user->year_level }}">
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Update User</button>
                </form>
             </div>
            </div>
        </div>
    </div>
</body>
</html>
