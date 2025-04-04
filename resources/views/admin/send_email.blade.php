<!DOCTYPE html>
<html lang="en">
  <head>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">

    <!-- Required meta tags -->
  <base href="/public">
    <style type="text/css">

    label
    {
      display: inline:block;
      
      width: 100px;
    }
    </style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    @include('admin.css')

  </head>
  <body style=" background: url('assets/img/adminimg/sendemail1.png') no-repeat center center fixed; background-size: cover;">
    
  
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

        
        @if(session()->has('message'))

        <div class="alert alert-success">

        <button type="button" class="close" data-dismiss="alert"></button>

        {{session()->get('message')}}
 
        </div>

        @endif
        
        <div>
          <h1 style="font-size: 52px; color:#f7a15c  ;" class="mb-4"><i class="bi bi-envelope" style="color: #f7a15c;"></i> New message </h1>
        </div>

        <form action="{{url('sendemail',$data->id)}}" method="POST">
            @csrf

        <div style="padding: 15px;">

        <input type="text" style="color:black; height: 34px;" class="rounded-lg w-[22rem] p-4" name="subject" required="" placeholder="Header of your email">
        </div>

        <div style="padding:15px;">

          <input type="text" style="color:black; height: 34px;" class="rounded-lg w-[22rem] p-4" name="greeting" required="" placeholder="Subject of your email">
 
        </div>

        <div style="padding:15px;">

        <input type="text" style="color:black; height: 34px;"  class="rounded-lg  w-[22rem] p-4" name="message" required="" placeholder="Purpose of your email">

        </div>

        <!-- <div style="padding:15px;">

          
          <input type="text" style="color:black; height: 34px;" class="rounded-lg  w-[22rem] p-4" name="actiontext" required="" placeholder="">
 
        </div>

        <div style="padding:15px;">

        
          <input type="text" style="color:black; height: 34px;" class="rounded-lg  w-[22rem] p-4" name="actionurl">
 
        </div>

        <div style="padding:15px;">

       
          <input type="text" style="color:black; height: 34px;" class="rounded-lg  w-[22rem] p-4" name="endpart" required="">
 
        </div> -->

     
        <div style="padding:15px;" class="flex justify-center">

        
        <input type="submit" class="btn btn-success w-[166px] h-[50px] rounded-lg" value="Send Email" style="background-color: #f7a15c; color: white; font-size: 20px; font-weight: bold;">

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