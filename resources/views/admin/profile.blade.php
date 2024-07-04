<!DOCTYPE html>
<html lang="en">
   @include('admin.includes.head') 
   <body>
      <div class="loader-wrapper">
         <div class="loader-index">
            <span></span>
         </div>
         <svg>
            <defs></defs>
            <filter id="goo">
               <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
               <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"></fecolormatrix>
            </filter>
         </svg>
      </div>
      <div class="page-wrapper compact-wrapper" id="pageWrapper">
         @include('admin.includes.topbar')
         <!-- Page Body Start-->
         <div class="page-body-wrapper">
            @include('admin.includes.sidebar') 
            <div class="page-body">
               <div class="container-fluid">
                  <div class="page-title">
                     <div class="row">
                        <div class="col-6">
                           <h3>User Profile</h3>
                        </div>
                        <div class="col-6">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item">
                                 <a>
                                 <i data-feather="home"></i>
                                 </a>
                              </li>
                              <li class="breadcrumb-item">Users</li>
                              <li class="breadcrumb-item active">User Profile</li>
                           </ol>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Container-fluid starts-->
               <div class="container-fluid">
                  <div class="user-profile">
                     <div class="row">
                        
                        @error('image')
                        <div class="alert alert-danger mb-2" id="hi" role="alert">
                           {{$message}}
                        </div>
                        @enderror
                        @error('email')
                        <div class="alert alert-danger mb-2" id="hi" role="alert">
                           {{$message}}
                        </div>
                    @enderror
                    @error('ssn')
                    <div class="alert alert-danger mb-2" id="hi" role="alert">
                           {{$message}}
                        </div>
                    @enderror
                        <!-- user profile first-style start-->
                        <div class="col-sm-12">
                           <div class="card hovercard text-center">
                              <div class="cardheader"></div>
                              <div class="user-image">
                                 <div class="avatar">
                                    <img alt="" src="{{asset('storage/app/' . $user->image)}}">
                                 </div>
                                 <div class="icon-wrapper">
                                    <i class="fa fa-edit" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg1"></i>
                                 </div>
                              </div>
                              <!--  Edit Employee Modal -->
                              <div class="modal fade bd-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                 <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title"> Edit User Detail </h5>
                                          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>
                                       <div class="modal-body">
                                          <form class="card" action="{{url('admin/profileeditaction')}}" method="post" enctype="multipart/form-data">
                                             @csrf
                                          
                                             <div class="card-body">
                                                <div class="row">
                                                   <div class="col-md-6">
                                                      <div class="mb-3">
                                                         <label class="float-start" for="recipient-name"> Name</label>
                                                         <input class="form-control" name="id" value="{{$user->id}}" type="hidden">

                                                         <input class="form-control" name="name" value="{{$user->name}}" type="text">
                                                      </div>
                                                   </div>
                                                   <div class="col-md-6">
                                                      <div class="mb-3">
                                                         <label class="float-start" for="recipient-name"> Email</label>
                                                         <input class="form-control" required name="email" value="{{$user->email}}" type="email">
                                                      </div>
                                                   </div>
                                                   <div class="col-md-6">
                                                      <div class="mb-3">
                                                         <label class="float-start" for="recipient-name"> Image</label>
                                                         <input class="form-control" name="image" type="file">
                                                      </div>
                                                   </div>
                                                   <div class="col-md-6">
                                                      <div class="mb-3">
                                                        <label class="float-start" for="recipient-name"> SSN</label>
                                                         <input class="form-control" id="ssn" name="ssn" value="{{$user->ssn}}" type="text">
                                                      </div>
                                                   </div>
                                                   <div class="col-md-6">
                                                      <div class="mb-3">
                                                         <label class="form-label float-start">Contact</label>
                                                         <input class="form-control" name="contact" value="{{$user->contact}}" type="text">
                                                      </div>
                                                   </div>
                                                   <div class="col-md-6">
                                                      <div class="mb-3">
                                                         <label class="form-label float-start">Street Address</label>
                                                         <input class="form-control" name="street" value="{{$user->street}}" type="text">
                                                      </div>
                                                   </div>
                                                   <div class="col-md-6">
                                                      <div class="mb-3">
                                                         <label class="form-label float-start">City</label>
                                                         <input class="form-control" name="city" value="{{$user->city}}" type="text">
                                                      </div>
                                                   </div>
                                                   <div class="col-md-6">
                                                      <div class="mb-3">
                                                         <label class="form-label float-start">State</label>
                                                         <input class="form-control" name="state" value="{{$user->state}}" type="text">
                                                      </div>
                                                   </div>
                                                   <div class="col-md-6">
                                                      <div class="mb-3">
                                                         <label class="form-label float-start">Zip Code</label>
                                                         <input class="form-control" name="zip" value="{{$user->zip}}" type="text">
                                                      </div>
                                                   </div>
                                                   <div class="col-md-6">
                                                      <div class="mb-3">
                                                         <label class="form-label float-start">Country</label>
                                                         <input class="form-control" name="country" value="{{$user->country}}" type="text">
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                                                <button class="btn btn-primary" type="submit" >Update</button>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- Modal End -->
                              <div class="info">
                                 <div class="row">
                                    <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                                       <div class="row">
                                          <div class="col-md-6">
                                             <div class="ttl-info text-start">
                                                <h6>
                                                   <i class="fa fa-envelope"></i>   Email
                                                </h6>
                                                <span>{{$user->email}}</span>
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="ttl-info text-start">
                                                <h6>
                                                   <i class="fa fa-calendar"></i>   SSN
                                                </h6>
                                                <span>{{$user->ssn}}</span>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                                       <div class="user-designation">
                                          <div class="title">
                                             <a target="_blank" href="#">{{$user->name}}</a>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                                       <div class="row">
                                          <div class="col-md-6">
                                             <div class="ttl-info text-start">
                                                <h6>
                                                   <i class="fa fa-phone"></i>   Contact Us
                                                </h6>
                                                <span>{{$user->contact}}</span>
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="ttl-info text-start">
                                                <h6>
                                                   <i class="fa fa-location-arrow"></i>   Location
                                                </h6>
                                                <span> {{$user->street}}, {{$user->city}},{{$user->state}},{{$user->zip}},{{$user->country}}</span>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <hr>
                              </div>
                           </div>
                        </div>
                        <!-- user profile first-style end-->
                     </div>

                     @php
            $count= 0;
            $count1= 0; 
            @endphp

             @foreach($business as $total)
              @php 
              $count = $count + count($total->branch_employee);
               $count1 = $count1 + $total->branch_reward->where('status',1)->count();
                @endphp 
               
               @endforeach 

                     <div class="row">
                       
                        <div class="col-md-6 col-xl-4 col-lg-4">
                           <div class="card o-hidden">
                           <a href="{{url('admin/view_businesses')}}">
                              <div class="bg-secondary b-r-4 card-body">
                                 <div class="media static-top-widget">
                                    <div class="align-self-center text-center">
                                       <i data-feather="briefcase"></i>
                                    </div>
                                    <div class="media-body">
                                       <span class="m-0">My Business</span>
                                       <h4 class="mb-0 counter">{{count($business)}}</h4>
                                    </div>
                                 </div>
                              </div>
</a>
                           </div>
                        </div>
                        <div class="col-sm-6 col-xl-4 col-lg-4">
                           <div class="card o-hidden">
                           <a href="{{url('admin/view_employees')}}">
                              <div class="bg-primary b-r-4 card-body">
                                 <div class="media static-top-widget">
                                    <div class="align-self-center text-center">
                                       <i data-feather="users"></i>
                                    </div>
                                    <div class="media-body">
                                       <span class="m-0">My Employees</span>
                                       <h4 class="mb-0 counter">{{$count}}</h4>
                                       </i>
                                    </div>
                                 </div>
                              </div>
</a>
                           </div>
                        </div>
                        <div class="col-sm-6 col-xl-4 col-lg-4">
                           <div class="card o-hidden">
                           <a href="{{url('admin/view_rewards')}}">
                              <div class="bg-secondary b-r-4 card-body">
                                 <div class="media static-top-widget">
                                    <div class="align-self-center text-center">
                                       <i data-feather="gift"></i>
                                    </div>
                                    <div class="media-body">
                                       <span class="m-0"> Active Rewards</span>
                                       <h4 class="mb-0 counter"> {{$count1 }}<h4>
                                       </i>
                                    </div>
                                 </div>
                              </div>
</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Container-fluid Ends-->
            </div>
            <!-- Container-fluid Ends-->
            <!-- footer start--> @include('admin.includes.footer')
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
      @if (session('message1'))
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
      <script>
         $('#hi').delay(2000).slideUp(1200);
      </script>


<script src="{{asset('public/assets/input-mask.js')}}"></script>
    <script src="{{asset('public/assets/jquery.inputmask.bundle.min.js')}}"></script>
    <script>
      $("#ssn").inputmask("999-99-9999");
    </script>
   </body>
</html>