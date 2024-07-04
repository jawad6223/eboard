<!DOCTYPE html>
<html lang="en">
   @include('admin.includes.head')
   <body>
      <div class="loader-wrapper">
         <div class="loader-index"><span></span></div>
         <svg>
            <defs></defs>
            <filter id="goo">
               <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
               <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
            </filter>
         </svg>
      </div>
      <div class="page-wrapper compact-wrapper" id="pageWrapper">
         @include('admin.includes.topbar')
         <!-- Page Body Start-->
         <div class="page-body-wrapper">
            @include('admin.includes.sidebar')
            <div class="page-body">
               <div class="container-fluid ">
                  <div class="page-title " style="padding-top:0px;">
                     <div class="row mt-4">
                        <div class="col-6">
                           <h3>Change Password</h3>
                        </div>
                        <div class="col-6">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="index.php">                                      
                                 <i data-feather="home"></i></a>
                              </li>
                              <li class="breadcrumb-item">Password</li>
                              <li class="breadcrumb-item active"> Change Password</li>
                           </ol>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Container-fluid starts-->
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="card">
                         
                           <div class="card-header">
                             

                              <form class="theme-form" method="post" action="{{url('admin/update_password_action')}}">
                                 @csrf
                                 <div class="row">
                                    <div class="col-md-4 ">
                                       <input class="form-control" value="" type="password" required name="oldpassword" placeholder="Current Password" >
                                      
                              @if (session('error'))
                              <div class="alert  mb-2" style="color:red;" role="alert">
                                 Enter a valid password and try again
                              </div>
                              @endif

                                    </div>
                                    <div class="col-md-4 ">
                                       <input class="form-control" id="password" type="password" required name="newpassword"  placeholder="New password" >
                                    </div>
                                    <div class="col-md-4 ">
                                       <input required class="form-control" id="confirm_password" type="password" name="confirmpassword"    placeholder="Confirm New Password" >
                                      
                                    </div>
                                 </div>
                                 <div class="card-footer text-end">
                                    <button class="btn btn-primary " name="submit" type="submit">Change Password</button>
                                 </div>
                           </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Container-fluid Ends-->
            <!-- footer start-->
            @include('admin.includes.footer')
         </div>
      </div>
      <!-- latest jquery-->
      <script src="{{asset('public/assets/js/jquery-3.5.1.min.js')}}"></script>
      <!-- Bootstrap js-->
      <script src="{{asset('public/assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
      <!-- feather icon js-->
      <script src="{{asset('public/assets/js/icons/feather-icon/feather.min.js')}}"></script>
      <script src="{{asset('public/assets/js/icons/feather-icon/feather-icon.js')}}"></script>
      <!-- scrollbar js-->
      <script src="{{asset('public/assets/js/scrollbar/simplebar.js')}}"></script>
      <script src="{{asset('public/assets/js/scrollbar/custom.js')}}"></script>
      <!-- Sidebar jquery-->
      <script src="{{asset('public/assets/js/config.js')}}"></script>
      <!-- Plugins JS start-->
      <script src="{{asset('public/assets/js/sidebar-menu.js')}}"></script>
      <script src="{{asset('public/assets/js/dropzone/dropzone.js')}}"></script>
      <script src="{{asset('public/assets/js/dropzone/dropzone-script.js')}}"></script>
      <script src="{{asset('public/assets/js/tooltip-init.js')}}"></script>
      <script src="{{asset('public/assets/js/notify/bootstrap-notify.min.js')}}"></script>
      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="https://use.fontawesome.com/43c99054a6.js"></script>
      <script src="{{asset('public/assets/js/script.js')}}"></script>
      <script src="{{asset('public/assets/js/select2/select2.full.min.js')}}"></script>
      <script src="{{asset('public/assets/js/select2/select2-custom.js')}}"></script>

      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>

      <script>
         $('#hi').delay(2000).slideUp(1200);
      </script>
      <!-- Validation confirm password -->
      <script>
         var password = document.getElementById("password")
         , confirm_password = document.getElementById("confirm_password");
         
         function validatePassword(){
           if(password.value != confirm_password.value) {
             confirm_password.setCustomValidity("You must enter the same new password and confirm password");
           } else {
             confirm_password.setCustomValidity(''); }
         }
         password.onchange = validatePassword;
         confirm_password.onkeyup = validatePassword;
      </script>
      <!--End  Validation confirm password -->



      @if (session('message'))

      <script>
         Swal.fire({
           position: 'top-end',
           icon: 'success',
           title: 'Successfully Updated',
           showConfirmButton: false,
           timer: 2500
         })
      </script>

                           @endif
   </body>
</html>