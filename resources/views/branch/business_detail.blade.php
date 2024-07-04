<!DOCTYPE html>
<html lang="en">
   @include('branch.includes.head') 
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
         @include('branch.includes.topbar')
         <!-- Page Body Start-->
         <div class="page-body-wrapper">
            @include('branch.includes.sidebar') 
            <div class="page-body">
               <div class="container-fluid">
                  <div class="page-title">
                     <div class="row">
                        <div class="col-6">
                           <h3>Business Detail</h3>
                        </div>
                        <div class="col-6">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item">
                                 <a>
                                 <i data-feather="home"></i>
                                 </a>
                              </li>
                              <li class="breadcrumb-item">Branch</li>
                              <li class="breadcrumb-item active">Business Detail</li>
                           </ol>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Container-fluid starts-->
               <div class="container-fluid">
                  <div class="user-profile">
                     <div class="row">
                        <!-- user profile first-style start-->
                        <div class="col-sm-12">
                           <div class="card hovercard text-center">
                              <div class="cardheader"></div>
                              <div class="user-image">
                                 <div class="avatar">
                                    <img alt="" src="{{asset('storage/app/'.$business->branch_company->logo)}}" style="width:110px;height:110px">
                                 </div>
                              </div>
                              <div class="info">
                                 <div class="row">
                                    <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                                       <div class="row">
                                          <div class="col-md-6">
                                             <div class="ttl-info text-start">
                                                <h6>
                                                   <i class="fa fa-envelope"></i> Email
                                                </h6>
                                                <span>{{$business->email}}</span>
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="ttl-info text-start">
                                                <h6>
                                                   <i class="fa fa-calendar"></i> Branch Code
                                                </h6>
                                                <span>{{$business->branch_number}}</span>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                                       <div class="user-designation">
                                          <div class="title">
                                             <a target="_blank" href="#">{{$business->branch_company->name}}</a>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                                       <div class="row">
                                          <div class="col-md-6">
                                             <div class="ttl-info text-start">
                                                <h6>
                                                   <i class="fa fa-phone"></i> Contact Us
                                                </h6>
                                                <span>{{$business->contact}}</span>
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="ttl-info text-start">
                                                <h6>
                                                   <i class="fa fa-location-arrow"></i> Location
                                                </h6>
                                                <span>
                                                {{$business->street}},{{$business->city}},{{$business->state}},{{$business->zip}},{{$business->country}}
                                                </span>
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
                     <div class="row mt-3">
                        <div class="col-sm-6 col-xl-4 col-lg-6">
                           <div class="card o-hidden">
                              <div class="bg-secondary b-r-4 card-body">
                                 <div class="media static-top-widget">
                                    <div class="align-self-center text-center">
                                       <i data-feather="users"></i>
                                    </div>
                                    <div class="media-body">
                                       <span class="m-0"> Total Employees</span>
                                       <h4 class="mb-0 counter">{{count($business->branch_employee)}}</h4>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6 col-xl-4 col-lg-6">
                           <div class="card o-hidden">
                              <div class="bg-primary b-r-4 card-body">
                                 <div class="media static-top-widget">
                                    <div class="align-self-center text-center">
                                       <i data-feather="gift"></i>
                                    </div>
                                    <div class="media-body">
                                       <span class="m-0"> Total Rewards</span>
                                       <h4 class="mb-0 counter">{{count($business->branch_reward)}}</h4>
                                       </i>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6 col-xl-4 col-lg-6">
                           <div class="card o-hidden">
                              <div class="bg-secondary b-r-4 card-body">
                                 <div class="media static-top-widget">
                                    <div class="align-self-center text-center">
                                       <i data-feather="gift"></i>
                                    </div>
                                    <div class="media-body">
                                       <span class="m-0"> Active Rewards</span>
                                       <h4 class="mb-0 counter">{{$business->branch_reward->where('status',1)->count()}}</h4>
                                       </i>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 col-xl-6 xl-100">
                        <div class="card">
                           <div class="card-body">
                              <ul class="nav nav-tabs border-tab nav-primary" id="info-tab" role="tablist">
                                 <li class="nav-item">
                                    <a class="nav-link active" id="info-home-tab" data-bs-toggle="tab" href="#info-home" role="tab" aria-controls="info-home" aria-selected="true">
                                    <i class="fa fa-user fa-md"></i>Employees </a>
                                 </li>
                              </ul>
                              <div class="tab-content" id="info-tabContent">
                                 <div class="tab-pane fade show active" id="info-home" role="tabpanel" aria-labelledby="info-home-tab">
                                    <div class="dt-ext table-responsive">
                                       <table class="display" id="responsive">
                                          <thead>
                                             <tr>
                                                <th>#</th>
                                                <th>Profiles</th>
                                                <th>Name</th>
                                                <!-- <th>Email</th> -->
                                                <th>Telephone</th>
                                                <th>Date</th>
                                                <th>Sales</th>
                                                <th>Rank</th>
                                                <th>Status</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             @php 
                                             $count =1;
                                             @endphp
                                             @foreach($all_employees as $employee)
                                             <tr>
                                                <td>{{$count}}</td>
                                                <td>
                                                   <img src="{{asset('storage/app/'.$employee->employee_detail->image)}}" style=" border-radius: 50%; height: 70px; width: 70px;">
                                                </td>
                                                <td>{{$employee->employee_detail->name}}</td>
                                                <!-- <td>{{$employee->employee_detail->email}}</td> -->
                                                <td>{{$employee->employee_detail->contact}}</td>
                                                <td>{{date('d/m/Y', strtotime($employee->date));}} </td>
                                                <td> $ {{$employee->sales}} </td>
                                                <td>
                                                   @if($count == 1)  <i class="fas fa-crown" style="color:#f49f1c;font-size:18px;"></i> <span style="font-size:20px;"> {{$count}}st  </span>
                                                   @elseif($count == 2) <i class="fas fa-stars" style="color:#a89632;font-size:25px;"></i> 
                                                   <span style="font-size:20px;">  {{$count}}nd <span>
                                                   @elseif($count == 3) {{$count}}rd
                                                   @else {{$count}}th
                                                   @endif
                                                </td>
                                                <td>
                                                   @foreach($compares as $compare)
                                                   @if($compare->user_id == $employee->user_id &&  $compare->date < $employee->date ) 
                                                   @php 
                                                   $perc =  (($employee->sales -   $compare->sales)/$compare->sales) *100;
                                                   @endphp
                                                   {{round($perc, 2)}} % 
                                                   @if($perc > 0)
                                                   <i class="fas fa-arrow-up" style="color:green;font-size:17px;padding-left:5px"></i>
                                                   @elseif($perc < 0)
                                                   <i class="fas fa-arrow-down" style="color:red;font-size:17px;padding-left:5px"></i>
                                                   @endif
                                                   @endif
                                                   @endforeach
                                                </td>
                                             </tr>
                                             @php
                                             $count++
                                             @endphp
                                             @endforeach
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Container-fluid Ends-->
         </div>
         <!-- Container-fluid Ends-->
         <!-- footer start--> @include('branch.includes.footer')
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
      <script src="{{asset('public/assets/js/select2/select2.full.min.js')}}"></script>
      <script src="{{asset('public/assets/js/select2/select2-custom.js')}}"></script>
      <!-- Theme js-->
      <script src="https://use.fontawesome.com/43c99054a6.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatables/datatable.custom.js')}}"></script>
      <script src="{{asset('public/assets/js/script.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/dataTables.buttons.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/jszip.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/buttons.colVis.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/pdfmake.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/vfs_fonts.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/dataTables.autoFill.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/dataTables.select.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/buttons.html5.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/buttons.print.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/dataTables.responsive.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/dataTables.keyTable.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/dataTables.colReorder.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/dataTables.scroller.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/custom.js')}}"></script>
      <script>
         $('#hi').delay(2000).slideUp(1200);
      </script>
   </body>
</html>