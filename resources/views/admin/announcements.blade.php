<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    @include('admin.announcecss')
<<<<<<< HEAD
   
=======
    <style>
        .form-control[type="date"] {
            font-size: 16px;
            padding: 12px;
            background-color: #f1f1f1;
            border-radius: 5px;
            color: black;
            border: 2px solid #AD1457;
        }
        .form-control {
            font-size: 16px;
            padding: 12px;
            background-color: #f1f1f1;
            border-radius: 5px;
            color: black;
        }
        select.form-control {
            color: black;
            border: 2px solid #AD1457;
            font-size: 16px;
            width: 100%;
        }

        select.form-control:focus {
            border-color: #9C1145;
            outline: none;
        }
        .card {
            margin-top: 0px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .mb-4 {
            margin-bottom: 20px;
        }
        .btn-submit {
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #AD1457;
            color: white;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #9C1145;
        }
        .container-wrapper {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            margin-top: 80px;
        }
    </style>
>>>>>>> ce459b4393ad907b4f5890ca5b6177e181cc4c00
</head>

<body>
    <div class="container-scroller">
        @include('admin.sidebar')
        @include('admin.navbar')

        <!-- Content Wrapper -->
        <div class="container container-wrapper">
            <!-- Announcement Card -->
            <div class="card">
<<<<<<< HEAD
                <div class="card-header" style="background-color: ;">
=======
                <div class="card-header">
>>>>>>> ce459b4393ad907b4f5890ca5b6177e181cc4c00
                    Create Announcement
                </div>
                <div class="card-body">
                    <!-- Show success message -->
                    @if(session('success'))
<<<<<<< HEAD
                    <div class="alert alert-success text-center">{{ session('success') }}</div>
=======
                        <div class="alert alert-success text-center">{{ session('success') }}</div>
>>>>>>> ce459b4393ad907b4f5890ca5b6177e181cc4c00
                    @endif

                    <!-- Show errors if validation fails -->
                    @if ($errors->any())
<<<<<<< HEAD
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
=======
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
>>>>>>> ce459b4393ad907b4f5890ca5b6177e181cc4c00
                    @endif

                    <!-- Announcement Form -->
                    <form action="{{ url('createAnnouncement') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Title Field -->
                        <div class="mb-4">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Announcement Title" required>
                        </div>

                        <!-- Message Field -->
                        <div class="mb-4">
                            <label for="message">Message</label>
<<<<<<< HEAD
                            <textarea class="form-control" name="message" rows="5" placeholder="Enter Announcement Message"
                                required></textarea>
                        </div>

=======
                            <textarea class="form-control" name="message" rows="5" placeholder="Enter Announcement Message" required></textarea>
                        </div>

                         <!-- Announcement Type -->
                        <div class="mb-4">
                            <label for="type">Announcement</label>
                            <select class="form-control" name="type" required>
                            <option value="" disabled>-- Select Type --</option>
                            <option value="School Event">School Event</option>
                            <option value="Holiday">Holiday</option>
                            <option value="Suspension">Suspension</option>
                         </select>
                        </div>

                         <!-- Expired Date -->
                         <div class="mb-4">
                            <label for="expired_date">Expired Date</label>
                            <input type="date" class="form-control" name="expired_date" required>
                         </div>

>>>>>>> ce459b4393ad907b4f5890ca5b6177e181cc4c00
                        <!-- Image Upload Field -->
                        <div class="mb-4">
                            <label for="image">Upload Image (optional)</label>
                            <input type="file" class="custom-file-input" name="image" accept="image/*">
                        </div>

                        <!-- Submit Button -->
<<<<<<< HEAD
                        <button type="submit" class="btn btn-submit" style="background-color: #AD1457; color: white;">Send Announcement</button>
=======
                        <button type="submit" class="btn-submit">Send Announcement</button>
>>>>>>> ce459b4393ad907b4f5890ca5b6177e181cc4c00
                    </form>
                </div>
            </div>
        </div>

        @include('admin.script')
    </div>
</body>

</html>
