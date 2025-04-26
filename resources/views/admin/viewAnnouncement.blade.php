<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href=" {{ asset('assets/img/adminimg/titlebaricon.ico') }}" type="image/icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Announcement</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @include('admin.css')
    @include('admin.script')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="../assets/css/maicons.css">



<link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">

<link rel="stylesheet" href="../assets/vendor/animate/animate.css">

<link rel="stylesheet" href="../assets/css/theme.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
  .card-horizontal {
    display: flex;
    flex-direction: row;
    height: 200px;
    /* overflow: hidden; */
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    position: relative;
  }

  .card-img-wrapper {
    position: relative;
    width: 30%;
    height: 100%;
  }

  .card-img-left {
    width: 30%;
    height: 100%;
    object-fit:cover;
    object-position: center;
    border-top-left-radius: 8px;
    border-bottom-left-radius: 8px;
    transition: transform 0.3s ease;
  }
  .card-img-left:hover {
    transform: scale(1.05);
    cursor: pointer;
  }

  .type-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background-color: #007bff;
    color: #fff;
    padding: 5px 10px;
    font-size: 0.75rem;
    border-radius: 20px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    z-index: 2;
  }

  .card-body-right {
    background-color: white;
    width: 70%;
    padding: 15px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    text-align: left;
  }

  .card-body-right .short-message,
  .card-body-right .full-message {
  width: 300px;              /* Set your preferred width */
  height: 150px;             /* Set a fixed height */
  overflow-y: auto;          /* Enables vertical scroll when content overflows */
  overflow-x: hidden;        /* Prevents horizontal scrolling */
  word-wrap: break-word;     /* Ensures long words wrap properly */
  padding: 10px;             /* Optional: for spacing inside */
  border: 1px solid #ccc;    /* Optional: visual styling */
  box-sizing: border-box;    /* Ensures padding stays within set width */
}


  .toggle-message {
    color: black !important;
    text-decoration: none !important;
    transition: color 0.3s ease;
  }

  .hover-message:hover {
    color: #006400;
    cursor: pointer;
  }

  .scroll {
  height: 200px;           /* Set fixed height */
  overflow-y: auto;        /* Scrollbar appears when content overflows */
  overflow-x: hidden;      /* Optional: hide horizontal scroll */
  padding: 10px;           /* Optional spacing */
  box-sizing: border-box;  /* Include padding in the height */
  margin-bottom: 10px;
  border: none;
}

</style>
</head>

<body style="background-color: #FAEBD7;">
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-12 p-0 m-0">
          <div class="ps-lg-1">
            <div class="d-flex align-items-center justify-content-between"></div>
          </div>
          <div class="d-flex align-items-center justify-content-between"></div>
        </div>
      </div>

         <!-- partial:partials/_sidebar.html -->
         @include('admin.sidebar')
      <!-- partial -->
      @include('admin.navbar')


            <!-- partial -->
            <div class="container-fluid w-100  mt-5" style="background-color: #FAEBD7;">
        <div class="mt-5">

<!-- Announcement -->
<div class="row">
    @foreach($announcements as $announcement)
      <div class="col-md-12 mb-3">
        <div class="card card-horizontal">

          {{-- Image on the left --}}
          @if($announcement->image)
            <img src="{{ asset($announcement->image) }}" class="card-img-left" alt="Announcement Image">
          @else
            <img src="{{ asset('assets/img/adminimg/noimageskeleton.png') }}" class="card-img-left" alt="Default Image"  >
          @endif

          {{-- Message on the right --}}
          <div class="card-body-right">
            <span class="type-badge">{{ $announcement->type }}</span>

            {{-- Full message directly --}}
            <div class="mt-auto text-red-500;" style="color: #AD1457; font-weight: bold;">
            
              <small class=" d-block text-2xl ">📌 {{ $announcement->title }} </small>
            </div>
            <div class="scroll">
            <p class="mb-2 ">{{ $announcement->message }}</p> 
            </div>
            <span class=" flex justify-end items-end w-full text-[32px]"> <span class="text-sm text-gray-500 flex justify-start w-full items-start">Upload on : {{ \Carbon\Carbon::parse($announcement->created_at)->format('h:i:s A - F j, Y (l)') }}</span>
                <a class="mr-4"><i class="bi bi-pencil-square" data-bs-toggle="modal" data-bs-target="#updateModal"></i></a>
                <a><i class="bi bi-trash" data-bs-toggle="modal" data-bs-target="#deleteModal"></i></a></span>
                
          </div>

        </div>
      </div>
    @endforeach
  </div>


<!-- Edit the Announcement Modal-->
 <div class="modal fade" id="updateModal" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">

        <div class="modal-header flex w-full justify-center items-center text-xl text-white" style="border: none; background-color: #60A5FA; font-weight: bold;">
            <span>UPDATE ANNOUNCEMENT</span>
        </div>
        <div class="modal-body m-4" style="border: none;">
            <span></span>
        </div>

        <div class="modal-footer" style="border: none; font-family:Arial, Helvetica, sans-serif; font-size: 0.8rem;  margin-bottom: 5px;">
        
            <button type="submit" aria-hidden="false" data-bs-dismiss="modal" style="background-color: gray;" class="rounded-lg p-2 text-white">Cancel</button>
            <button type="submit" style="background-color: #007bff;" class="rounded-lg p-2 text-white">Update</button>
        </div>
        </div>
    </div>
 </div>




<!-- Confirmation remove Announcement Modal-->
 <div  class="modal fade" id="deleteModal" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">

        <div class="modal-header bg-red-600 flex w-full justify-center items-center text-white text-xl " style="border: none; font-weight: bold;">
            <h5 class="modal-title" id="deleteModalLabel" > <i class="bi bi-exclamation-circle-fill text-orange-300 text-2xl"></i> &nbsp; DELETE ANNOUNCENNT</h5>
          
        </div>
        <div class="modal-body" style="border: none; word-break: break-all;">

        <span class="message flex w-full justify-center items-center text-lg mb-2"> Are you sure you want to REMOVE Annoucement </span>
        <span class="w-full flex justify-center items-center text-2xl text-red-500">{{ $announcement->title }}</span>
    </div>
    <span class="text-gray-500 text-sm ml-4 mb-4">This can't be undone once you already remove this announcement.</span>

        <div class="modal-footer" style="border: none; font-family:Arial, Helvetica, sans-serif; font-size: 0.8rem;margin-bottom: 5px;">
          
            <button type="submit" aria-hidden="false" data-bs-dismiss="modal" class="p-2 rounded-lg text-white" style="background-color: #007bff; " >Cancel</button>
            <button type="submit" class="p-2 bg-red-600 rounded-lg text-white mx-2 py-2">Yes, Remove</button>
        </div>
        </div>

    </div>
 </div>


  <script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../assets/vendor/wow/wow.min.js"></script>

<script src="../assets/js/theme.js"></script>
</body>
</html>