<!DOCTYPE html>
<html lang="en">
  <head>

    <style type="text/css">

    label
    {
      display: inline:block;
      
      width: 100px;
    }
    </style>

    
    @include('admin.css')

  </head>
  <body style="background-color: #FAEBD7;">
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="">
            <div class="ps-lg-1">
              <div class="d-flex align-items-center justify-content-between">
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
            </div>
          </div>
        </div>
      </div>  
      <!-- partial:partials/_sidebar.html -->
 
      @include('admin.sidebar')

      <!-- partial -->
     
       @include('admin.navbar')

        <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        
      <div class="container" align="center" style="padding-top:50px;">
    <div style="width: 500px; background-color: #f9f9f9; padding: 30px; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.2); text-align: center;">

        @if(session()->has('message'))
        <div class="alert alert-success" style="margin-bottom: 20px; padding: 10px; border-radius: 5px;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session()->get('message') }}
        </div>
        @endif

        <form action="{{ url('upload_doctor') }}" method="POST" enctype="multipart/form-data" style="text-align: left;">
            @csrf

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">Doctor Name</label>
                <input type="text" name="name" placeholder="Write Doctor Name" required
                    style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; color: #333; font-size: 16px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">Phone</label>
                <input type="text" name="number" placeholder="Write the Number" required
                    style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; color: #333; font-size: 16px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">Speciality</label>
                <select name="speciality" required
                    style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; color: #333; font-size: 16px;">
                    <option value="">Select Speciality</option>
                    <option value="head nurse">Clinic Staff</option>
                    <option value="nurse">Registered Nurse</option>
                    <option value="Physicians">Physician / Surgeon</option>
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">Doctor Image</label>
                <input type="file" name="file" required
                    style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; color: #333; font-size: 16px;">
            </div>

            <div style="text-align: center;">
                <input type="submit" class="btn btn-success"
                    style="background-color: #28a745; color: #fff; padding: 12px 25px; border-radius: 8px; border: none; cursor: pointer; font-size: 18px; transition: all 0.3s;">
            </div>
        </form>
    </div>
</div>



     

    <!-- container-scroller -->
    <!-- plugins:js -->
    

    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>