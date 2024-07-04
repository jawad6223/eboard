<!DOCTYPE html>
<html lang="en">
   <!-- Mirrored from admin.pixelstrap.com/cuba/theme/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 27 Apr 2021 09:50:27 GMT -->
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
      <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
      <meta name="author" content="pixelstrap">
      <link rel="icon" href="{{asset('public/assets/images/favicon.png')}}" type="image/x-icon">
      <link rel="shortcut icon" href="{{asset('public/assets/images/favicon.png')}}" type="image/x-icon">
      <title>Eboard</title>
      <!-- Google font-->
      <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/font-awesome.css') }}">
      <!-- ico-font-->
      <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/vendors/icofont.css')}}">
      <!-- Themify icon-->
      <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/vendors/themify.css')}}">
      <!-- Flag icon-->
      <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/vendors/flag-icon.css')}}">
      <!-- Feather icon-->
      <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/vendors/feather-icon.css')}}">
      <!-- Plugins css start-->
      <!-- Plugins css Ends-->
      <!-- Bootstrap css-->
      <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/vendors/bootstrap.css')}}">
      <!-- App css-->
      <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/style.css')}}">
      <link id="color" rel="stylesheet" href="{{asset('public/assets/css/color-1.css')}}" media="screen">
      <!-- Responsive css-->
      <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/responsive.css')}}">
   </head>
   <body>
      <!-- login page start-->
      <div class="container-fluid p-0">
         <div class="row m-0">
            <div class="col-12 p-0">
               <div class="login-card">
                  <div>
                     <div><a class="logo" href=""><img class="img-fluid for-light" src="{{asset('public/assets/images/logo/login.png')}}" style="height:65px;" alt="looginpage">
                        </a>
                     </div>
                     <div class="login-main">
                     @if (session('error1'))
              <div class="alert alert-danger mb-2" id="hi" role="alert">
Invalid Credentials 
</div>                   
   @endif

                        <form class="theme-form" action="{{url('branch/verification_action')}}" method="post">
                           @csrf
                           <h3 style="text-align:center">Verification</h3>
                           <p  style="text-align:center">You will get a otp via email</p>
                          
                           <div class="form-group">
                      <input   type="hidden"   name="user_id" value={{$id}} >

                              <div class="form-input position-relative">
                                 <input class="form-control" id="login_password" type="password" required  name="otp" placeholder="">
                                       @if (session('error'))
         <span class="text-danger">
                      Incorrect OTP Try Again!!
                      </span>                 
   @endif
                              
                                 <div class="show-hide">
                                    <span class="show" onclick="visibility()"> </span>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group mb-0">
                              <div class="checkbox p-0">
                                 <input id="checkbox1" type="checkbox">
                              </div>
                              
                              <div class="text-end mt-3">
                                 <button class="btn btn-primary btn-block w-100" type="submit">Verify</button>
                              </div>
                               <p class="mt-4 mb-0">Didn't receive the verification OTP?<a class="ms-2" href="{{url('branch/again_verification_action/' .$id)}}">Resend Again</a></p>
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
      </div>
      <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
      <script>
         function visibility() {
         var x = document.getElementById('login_password');
         if (x.type === 'password') {
         x.type = "text";
         $('#eyeShow').show();
         $('#eyeSlash').hide();
         }else {
         x.type = "password";
         $('#eyeShow').hide();
         $('#eyeSlash').show();
         }
         }
      </script>
      <script>
         $('#hi').delay(2000).slideUp(1200);
      </script>
   </body>
   <!-- Mirrored from admin.pixelstrap.com/cuba/theme/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 27 Apr 2021 09:50:27 GMT -->
</html>