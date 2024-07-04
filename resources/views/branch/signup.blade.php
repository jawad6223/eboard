<!DOCTYPE html>
<html lang="en">
   <!-- Mirrored from admin.pixelstrap.com/cuba/theme/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 27 Apr 2021 09:50:29 GMT -->
   @include('branch.includes.head')
   <body>
      <!-- login page start-->
      <div class="container-fluid p-0">
         <div class="row m-0">
            <div class="col-12 p-0">
               <div class="login-card">
                  <div>
                     <div><a class="logo" href=""><img class="img-fluid for-light" src="{{asset('public/assets/images/logo/login.png')}}" alt="looginpage" style="height:65px;"><img class="img-fluid for-dark" src="{{asset('public/assets/images/logo/logo_dark.png')}}" alt="looginpage" style="height:65px;"></a></div>
                     <div class="login-main">
                        <form class="theme-form"  method="post" action="{{url('branch/signupaction')}}"  enctype="multipart/form-data">
                           @csrf
                           <h4>Create your account</h4>
                           <p>Enter your personal details to create account</p>
                           <div class="form-group">
                              <label class="col-form-label">Name:</label>
                              <input class="form-control" type="text" name="name" required>
                              
                           </div>
                           <div class="form-group">
                              <label class="col-form-label">Email:</label>
                              <input class="form-control" type="email" name="email" required>
                              
                                       @error('email')
                                       <span class="text-danger">
                                       {{$message}}
                                       </span>
                                       @enderror
                           </div>
                           <div class="form-group">
                              <label class="col-form-label">Password</label>
                              <div class="form-input position-relative">
                                 <input class="form-control" type="password" name="password" id="password" required placeholder="">
                                 
                                       @error('password')
                                       <span class="text-danger">
                                       {{$message}}
                                       </span>
                                       @enderror
                                
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-form-label">Confirm Password</label>
                              <div class="form-input position-relative">
                                 <input class="form-control" type="password" name="confirm_password" id="confirm_password" required placeholder="">
                                 
                                       @error('confirm_password')
                                       <span class="text-danger">
                                       {{$message}}
                                       </span>
                                       @enderror
                              </div>
                           </div>
                           <div class="form-group mb-0">
                              <button class="btn btn-primary btn-block w-100" type="submit">Create Account</button>
                           </div>
                           <div class="social mt-4">
                              <div class="btn-showcase">
                               
                              </div>
                              <p class="mt-4 mb-0">Already have an account?<a class="ms-2" href="{{url('branch/login')}}">Sign in</a></p>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
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
         <!-- Sidebar jquery-->
         <script src="{{asset('public/assets/js/config.js')}}"></script>
         <!-- Plugins JS start-->
         <!-- Plugins JS Ends-->
         <!-- Theme js-->
         <script src="{{asset('public/assets/js/script.js')}}"></script>
         <!-- login js-->
         <!-- Plugin used-->
         <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
         <!-- Plugin used-->
         <script>
            $('#hi').delay(3500).slideUp(1200);
         </script>
          <script>
         var password = document.getElementById("password")
         , confirm_password = document.getElementById("confirm_password");
         
         function validatePassword(){
           if(password.value != confirm_password.value) {
             confirm_password.setCustomValidity("You must enter password and confirm password same");
           } else {
             confirm_password.setCustomValidity(''); }
         }
         password.onchange = validatePassword;
         confirm_password.onkeyup = validatePassword;
      </script>
      </div>
   </body>
   <!-- Mirrored from admin.pixelstrap.com/cuba/theme/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 27 Apr 2021 09:50:29 GMT -->
</html>