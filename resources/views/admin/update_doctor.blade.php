<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    
    @include('admin.css')

    <style>
        body {
            background-color: #F5F5F5;
            font-family: 'Arial', sans-serif;
        }

        .form-container {
            margin-top: 80px;
            padding: 40px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 50%;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            display: block;
        }

        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
        }

        input[type="text"]:focus, input[type="file"]:focus {
            border-color: #00D9A5;
            box-shadow: 0 0 5px rgba(0, 217, 165, 0.5);
        }

        .image-container {
            margin-top: 10px;
            text-align: center;
        }

        img {
            border-radius: 10px;
            border: 2px solid #ddd;
            transition: transform 0.3s ease-in-out;
        }

        img:hover {
            transform: scale(1.05);
        }

        .btn-primary {
            background-color: #00D9A5;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #00B08C;
            box-shadow: 0 4px 8px rgba(0, 217, 165, 0.2);
        }

        .alert-success {
            background-color: #D4EDDA;
            color: #155724;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .close {
            float: right;
            font-size: 18px;
            cursor: pointer;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-container {
                width: 90%;
                padding: 20px;
            }

            input[type="text"], input[type="file"], .btn-primary {
                font-size: 14px;
                padding: 10px;
            }
        
    </style>
</head>
<body style="background-color: #FAEBD7;">
    <div class="container-scroller">
        <!-- Sidebar -->
        @include('admin.sidebar')

        <!-- Navbar -->
        @include('admin.navbar')

        <!-- Main Content -->
        <div class="container-fluid page-body-wrapper">
            <div class="container d-flex justify-content-center">
                <div class="form-container">
                <h2 class="text-center" style="color: #333; margin-bottom: 30px; font-size: 20px; font-weight: 600;">
                Update Doctor Details
                </h2>


                    <!-- Success Message -->
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session()->get('message') }}
                    </div>
                    @endif

                    <!-- Form Section -->
                    <form action="{{ url('editdoctor', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Doctor Name -->
                        <div class="form-group">
                            <label>Doctor Name</label>
                            <input style="color: #333; font-weight: 500;" type="text" name="name" value="{{ $data->name }}" required>
                        </div>

                        <!-- Phone -->
                        <div class="form-group">
                            <label>Phone</label>
                            <input style="color: #333; font-weight: 500;" type="text" name="phone" value="{{ $data->phone }}" required>
                        </div>

                        <!-- Speciality -->
                        <div class="form-group">
                            <label>Speciality</label>
                            <input style="color: #333; font-weight: 500;" type="text" name="speciality" value="{{ $data->speciality }}" required>
                        </div>

                        <!-- Current Image -->
                        <div class="form-group image-container">
                            <label>Current Image</label><br>
                            <img height="150" width="150" src="doctorimage/{{ $data->image }}" alt="Doctor Image">
                        </div>

                        <!-- Upload New Image -->
                        <div class="form-group">
                            <label>Change Image</label>
                            <input style="color: #333; font-weight: 500;" type="file" name="file">
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Update Details">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('admin.script')
</body>
</html>
