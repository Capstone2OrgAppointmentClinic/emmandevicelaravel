<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('admin.css')
<style>
.form-container {
    max-width: 700px;
    margin: 40px auto;
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    background-color: #AD1457;
}
body {
    background-color: #FAEBD7;
}
.form-control {
    background-color: #fff;
    color: #000;
    transition: background-color 0.3s ease, color 0.3s ease;
        }
.form-control:focus {
    background-color: #fff;
    color: #000;
    box-shadow: none;
    outline: none;
}
.invalid-feedback {
    color: red;
    font-size: 12px;
}

    </style>
</head>
<body style="background-color: #FAEBD7;">
    <div class="container-scroller">
        @include('admin.sidebar')
        @include('admin.navbar')

        <div class="content-wrapper" style="background-color: #FAEBD7;">
            <div class="form-container">
                @if(session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session()->get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
               @endif
                <form action="{{ url('/updateUser', $user->id) }}" method="POST">
                    @csrf

                <div class="mb-3">
    <label class="form-label">Name</label>
    <input 
        type="text" 
        name="name" 
        class="form-control" 
        value="{{ old('name', $user->name) }}" 
        required 
        placeholder="Enter your name"
        oninput="validateName()">
    <div id="name-warning" class="invalid-feedback" style="display: none;">
        Please enter only letters.
    </div>
    </div>

<script>
function validateName() {
    const nameInput = document.querySelector('[name="name"]');
    const warningMessage = document.getElementById('name-warning');
    const nameValue = nameInput.value;

    const isValidName = /^[A-Za-z\s]*$/.test(nameValue);

    if (!isValidName) {
        warningMessage.style.display = 'block';
    } else {
        warningMessage.style.display = 'none';
        }
    }
</script>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter your email address"value="{{ $user->email }}" required>
        </div>

        <div class="form-group">
           <label for="phone">Phone Number</label>
           <input 
        type="text" 
        name="phone" 
        id="phone" 
        class="form-control" 
        value="{{ old('phone', $user->phone) }}" 
        required 
        placeholder="Enter phone number"
        oninput="validatePhoneNumber()">
         <div id="phone-warning" class="invalid-feedback" style="display: none;">
        Please enter only numbers.
        </div>

<script>
function validatePhoneNumber() {
    const phoneInput = document.getElementById('phone');
    const warningMessage = document.getElementById('phone-warning');
    const phoneValue = phoneInput.value;

    const isValidPhone = /^[0-9]*$/.test(phoneValue);

    if (!isValidPhone) {
        warningMessage.style.display = 'block'; 
    } else {
        warningMessage.style.display = 'none';
        }
    }
</script>

        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" placeholder="Enter your complete address" class="form-control" value="{{ $user->address }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Course/Strand</label>
            <select name="course" id="course" class="form-select">
            </select>
        </div>
                    
        <div class="mb-3">
            <label class="form-label">Student ID</label>
            <input type="text" name="student_id" class="form-control" placeholder="student id" value="{{ $user->student_id }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Education Level</label>
            <select name="education_level" id="education_level" class="form-select" required onchange="updateYearOptions()">
        <option value="college" {{ $user->education_level == 'college' ? 'selected' : '' }}>College</option>
        <option value="junior_high" {{ $user->education_level == 'junior_high' ? 'selected' : '' }}>Junior High</option>
        <option value="senior_high" {{ $user->education_level == 'senior_high' ? 'selected' : '' }}>Senior High</option>
        </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Year Level</label>
            <select name="year_level" id="year_level" class="form-select">
        </select>
        </div>
        <button type="submit" class="btn btn-success mt-4">Update User</button>
                </form>
            </div>
        </div>
    </div>
<script>
function updateYearOptions() {
    const edu = document.getElementById('education_level').value;
    const yearLevel = document.getElementById('year_level');
    const course = document.getElementById('course');

    yearLevel.innerHTML = '';
    course.innerHTML = '';

    if (edu === 'college') {
        ['1st Year', '2nd Year', '3rd Year', '4th Year'].forEach(yr => {
            yearLevel.innerHTML += `<option value="${yr}">${yr}</option>`;
        });
    } else if (edu === 'senior_high') {
        ['Grade 11', 'Grade 12'].forEach(yr => {
            yearLevel.innerHTML += `<option value="${yr}">${yr}</option>`;
        });
    } else {
        yearLevel.innerHTML = `<option value="">N/A</option>`;
    }

    if (edu === 'college') {
        ['BSIT', 'BSHM', 'BEED', 'BSA', 'BSBA'].forEach(c => {
            course.innerHTML += `<option value="${c}">${c}</option>`;
        });
    } else if (edu === 'senior_high') {
        ['ABM', 'ICT', 'HUMSS'].forEach(c => {
            course.innerHTML += `<option value="${c}">${c}</option>`;
        });
    } else {
        course.innerHTML = `<option value="">N/A</option>`;
    }
    const savedYear = "{{ $user->year_level }}";
    const savedCourse = "{{ $user->course }}";

    if (savedYear) {
        [...yearLevel.options].forEach(opt => {
            if (opt.value === savedYear) {
                opt.selected = true;
            }
        });
    }

    if (savedCourse) {
        [...course.options].forEach(opt => {
            if (opt.value === savedCourse) {
                opt.selected = true;
            }
        });
    }
}

window.onload = updateYearOptions;
</script>

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

/* Fix white background */
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

</body>
</html>
