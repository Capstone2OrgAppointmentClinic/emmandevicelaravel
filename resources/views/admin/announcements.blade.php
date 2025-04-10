<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    @include('admin.announcecss')
   
</head>

<body>
    <div class="container-scroller">
        @include('admin.sidebar')
        @include('admin.navbar')

        <!-- Content Wrapper -->
        <div class="container container-wrapper">
            <!-- Announcement Card -->
            <div class="card">
                <div class="card-header" style="background-color: ;">
                    Create Announcement
                </div>
                <div class="card-body">
                    <!-- Show success message -->
                    @if(session('success'))
                    <div class="alert alert-success text-center">{{ session('success') }}</div>
                    @endif

                    <!-- Show errors if validation fails -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
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
                            <textarea class="form-control" name="message" rows="5" placeholder="Enter Announcement Message"
                                required></textarea>
                        </div>

                        <!-- Image Upload Field -->
                        <div class="mb-4">
                            <label for="image">Upload Image (optional)</label>
                            <input type="file" class="custom-file-input" name="image" accept="image/*">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-submit" style="background-color: #AD1457; color: white;">Send Announcement</button>
                    </form>
                </div>
            </div>
        </div>

        @include('admin.script')
    </div>
</body>

</html>
