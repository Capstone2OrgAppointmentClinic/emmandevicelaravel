<!DOCTYPE html>
<html lang="en">
<head>
    
    <!-- Required meta tags -->
    @include('admin.css')
    <style>
        body {
            background-color: #FAEBD7;
        }

        .table-container {
            margin-top: 50px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 90%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #AD1457;
            color: white;
            font-size: 16px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        img {
            border-radius: 8px;
        }

        .btn {
            padding: 8px 12px;
            font-size: 14px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #d9534f;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>

<link href="/src/styles.css" rel="stylesheet">
</head>
<body>
    <div class="container-scroller">
        <!-- Sidebar -->
        @include('admin.sidebar')

        <!-- Navbar -->
        @include('admin.navbar')

        <!-- Main Content -->
        <div class="container-fluid page-body-wrapper">
            <div class="container d-flex justify-content-center">
                <div class="table-container">
                    <h2 class="text-center" style="color: #333;">Manage Doctors</h2>
                    <a href="{{ url('add_doctor_view') }}" class="btn text-white" style="background-color: #AD1457;">Add Doctor</a>                    <table>
                        <thead>
                            <tr ">
                                <th class="bg-[#AD1457]">Doctor Name</th>
                                <th class="bg-[#AD1457]">Phone</th>
                                <th class="bg-[#AD1457]">Speciality</th>
                                <th class="bg-[#AD1457]">Image</th >
                                <th class="bg-[#AD1457]">Remove</th>
                                <th class="bg-[#AD1457]">Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $doctor)
                            <tr>
                                <td style="color: #333; font-weight: 500;">{{ $doctor->name }}</td>
                                <td style="color: #333; font-weight: 500;">{{ $doctor->phone }}</td>
                                <td style="color: #333; font-weight: 500;">{{ $doctor->speciality }}</td>
                                <td><img height="100" width="100" src="doctorimage/{{ $doctor->image }}"></td>
                                <td>
                                    <a onclick="return confirm('Are you sure to remove this?')" class="btn btn-danger" href="{{ url('removedoctor', $doctor->id) }}">Remove</a>
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="{{ url('updatedoctor', $doctor->id) }}">Update</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admin.script')
</body>
</html>
