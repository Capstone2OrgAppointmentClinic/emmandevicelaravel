<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
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
        
      

        <div class="container" align="center" style="padding-top:100px;">

        <h1 style="background-color:yellow; text-align:center; font-size: 35px; margin:10px;">IN DEVELOPMENT</h1>
        
        @if(session()->has('message'))

        <div class="alert alert-success">

        <button type="button" class="close" data-dismiss="alert"></button>

        {{session()->get('message')}}
 
        </div>

        @endif

        <form action="{{url('sendemail',$data->id)}}" method="POST">
            @csrf

        <div style="padding:15px;">

          <label>Greeting</label>
          <input type="text" style="color:black;" name="greeting" required="">
 
        </div>
        
        <div style="padding:15px;">

        <label>Body</label>
        <input type="text" style="color:black; padding:10px" name="body" required="">

        </div>

        <div style="padding:15px;">

          <label>ActionText</label>
          <input type="text" style="color:black;" name="actiontext" required="">
 
        </div>

        <div style="padding:15px;">

          <label>Action Url</label>
          <input type="text" style="color:black;" name="actionurl">
 
        </div>

        <div style="padding:15px;">

          <label>End Part</label>
          <input type="text" style="color:black;" name="endpart" required="">
 
        </div>

     
        <div style="padding:15px;">

        
        <input type="submit" class="btn btn-success">

        </div>
        
    
         </div>



        </form>


        </div>



     </div>
     

    <!-- container-scroller -->
    <!-- plugins:js -->
    
    <!-- End custom js for this page -->
  </body>
</html>