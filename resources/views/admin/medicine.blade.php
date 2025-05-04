<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('assets/img/adminimg/titlebaricon.ico') }}" type="image/icon">
    @include('admin.css')


</head>

<body style="background-color: #FAEBD7;">
    <div class="container-scroller" style="background-color: #FAEBD7;">
        @include('admin.sidebar')
        @include('admin.navbar')

        <div class="container" style="margin-top: 100px;">
            <!-- Add Medicine Button -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 style="color:black;">Medicine List</h2>
               
            <!-- Search Bar -->
            <div style="width:80%;">
            <input type="text" style="width:250px; color:black;background-color:white;"" id="medicineSearch" class="form-control" placeholder="Search medicine..">
            </div>
            
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMedicineModal">
                    Add Medicine
                </button>
            </div>

            <!-- Session Message -->
            @if(session('message'))
            <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
                <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                    <div class="toast-body" style="background-color: white; color: #006400;">
                        {{ session('message') }}
                    </div>
                </div>
            </div>
            @endif


            <!-- Medicine Table -->
            <div class="table-responsive">
    <table class="table table-bordered table-striped" id="medicineTable">
        <thead style="background-color: #AD1457;" class="text-white">
            <tr>
                <th class="text-center text-white">Product Name</th>
                <th class="text-center text-white">Category</th>
                <th class="text-center text-white">Stock / Quantity</th>
                <th class="text-center text-white">Description</th>
                <th class="text-center text-white">Expiry Date</th>
                <th class="text-center text-white" style="width:20px;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medicines as $med)
                <tr>
                    <td>{{ $med->product_name }}</td>
                    <td>{{ $med->category }}</td>
                    <td>{{ $med->quantity }}</td>
                    <td>{{ $med->description }}</td>
                    <td>{{ $med->expiry_date }}</td>
                    <td>
                        <!-- Update Button -->
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal{{ $med->id }}">
                            Update
                        </button>
                    </td>
                </tr>

              <!-- Update medicine -->
            <div class="modal fade" id="updateModal{{ $med->id }}" tabindex="-1" aria-labelledby="updateModalLabel{{ $med->id }}" aria-hidden="true">
                <div class="modal-dialog" style="max-width: 50%;">
                    <div class="modal-content" style="background-color:white;">
                        <form action="{{ route('medicine.update', $med->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header" style="background-color: #AD1457;">
                                <h5 class="modal-title" id="updateModalLabel{{ $med->id }}" style="color: white;">Update Medicine</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label" style="color:black;">Product Name</label>
                                        <input type="text" style="color:black;background-color:white;"  name="product_name" value="{{ $med->product_name }}" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" style="color:black;">Category</label>
                                        <input type="text" style="color:black;background-color:white;"  name="category" value="{{ $med->category }}" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" style="color:black;">Stock / Quantity</label>
                                        <input type="number" style="color:black;background-color:white;"  name="quantity" value="{{ $med->quantity }}" class="form-control" min="0" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" style="color:black;">Expiry Date</label>
                                        <input type="date" style="color:black;background-color:white;"  name="expiry_date" value="{{ $med->expiry_date }}" class="form-control" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" style="color:black;">Description</label>
                                        <textarea name="description" style="color:black;background-color:white;" class="form-control" rows="2" required>{{ $med->description }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer" style="background-color: #AD1457;">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

        <!-- Add Medicine -->
<div class="modal fade" id="addMedicineModal" tabindex="-1" aria-labelledby="addMedicineLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 50%;">
        <div class="modal-content" style="background-color:white;">
            <form action="{{ route('medicine.store') }}" method="POST">
                @csrf
                <div class="modal-header" style="background-color: #AD1457;">
                    <h5 class="modal-title" id="addMedicineLabel">Add Medicine</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" style="color:black;">Product Name</label>
                                <input type="text" style="color:black;background-color:white;" name="product_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" style="color:black;">Category</label>
                                <input type="text" style="color:black;background-color:white;" name="category" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" style="color:black;">Stock / Quantity</label>
                                <input type="number" style="color:black;background-color:white;" name="quantity" class="form-control" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" style="color:black;">Expiry Date</label>
                                <input type="date" style="color:black;background-color:white;" name="expiry_date" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color:black;">Description</label>
                        <textarea name="description" style="color:black;background-color:white;" class="form-control" required></textarea>
                    </div>
                </div>

                <div class="modal-footer" style="background-color: #AD1457;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add Medicine</button>
                </div>
            </form>
        </div>
    </div>
</div>



    

<!-- Logs History Modal -->
<div class="modal fade" id="logsModal" tabindex="-1" aria-labelledby="logsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="max-width: 90%;">
        <div class="modal-content" style="background-color:white;">
            <div class="modal-header d-flex justify-content-between align-items-center">

            <div class="btn-group">
                    <button class="btn btn-sm btn-outline-primary" id="showStudentLogsBtn" style="width: 150px;">Student Logs</button>
                    <button class="btn btn-sm btn-outline-success" id="showAdminLogsBtn" style="width: 150px;">Admin Logs</button>
                </div>
<div class="flex justify-center w-full items-center">
<h5 class="modal-title" id="logsModalLabel" style="margin-right: 250px;">Logs History</h5>

</div>


                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- Student Logs Section -->
                <div id="studentLogsSection">
      

                     <!-- 🔍 Search Input -->
                <input type="text" class="form-control mb-2 search-input" style="width:250px;background-color:white;color:black;" id="studentSearchInput" placeholder="Search student name">
                      
                <div class="table-wrapper table-responsive" style=" max-height: 350px;">
                        <table class="table table-bordered mb-0 ">
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
                </div>

                <!-- Admin Logs Section -->
                <div id="adminLogsSection" style="display: none;">
             
                
                <!-- 🔍 Search Input -->
                <input type="text" class="form-control mb-2 search-input" id="adminSearchInput" style="width:250px; background-color:white;color:black;" placeholder="Search admin name...">
 
                    <div class="table-wrapper" style=" max-height: 350px;overflow-y: auto;">
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
                </div>

                

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const studentBtn = document.getElementById("showStudentLogsBtn");
    const adminBtn = document.getElementById("showAdminLogsBtn");
    const studentSection = document.getElementById("studentLogsSection");
    const adminSection = document.getElementById("adminLogsSection");

    studentBtn.addEventListener("click", () => {
        studentSection.style.display = "block";
        adminSection.style.display = "none";
    });

    adminBtn.addEventListener("click", () => {
        studentSection.style.display = "none";
        adminSection.style.display = "block";
    });

    const studentSearchInput = document.getElementById("studentSearchInput");
    studentSearchInput.addEventListener("keyup", function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll("#studentLogsSection table tbody tr");
        rows.forEach(row => {
            const nameCell = row.querySelector("td");
            if (nameCell && nameCell.textContent.toLowerCase().includes(filter)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });

    const adminSearchInput = document.getElementById("adminSearchInput");
    adminSearchInput.addEventListener("keyup", function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll("#adminLogsSection table tbody tr");
        rows.forEach(row => {
            const nameCell = row.querySelector("td");
            if (nameCell && nameCell.textContent.toLowerCase().includes(filter)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
});
</script>

        <script>
            document.getElementById('medicineSearch').addEventListener('keyup', function () {
                let filter = this.value.toLowerCase();
                let rows = document.querySelectorAll('#medicineTable tbody tr');

                rows.forEach(row => {
                    let product = row.children[0].textContent.toLowerCase();
                    let category = row.children[1].textContent.toLowerCase();
                    let quantity = row.children[2].textContent.toLowerCase();

                    if (product.includes(filter) || category.includes(filter) || quantity.includes(filter)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        </script>

        
        <script>
            var toastElList = [].slice.call(document.querySelectorAll('.toast'))
            var toastList = toastElList.map(function (toastEl) {
                return new bootstrap.Toast(toastEl)
            })
            toastList.forEach(toast => toast.show());
        </script>



@include('admin.script')
    </div>
</body>
</html>
