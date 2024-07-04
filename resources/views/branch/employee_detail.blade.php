<!DOCTYPE html>
<html lang="en"> @include('branch.includes.head') <body>
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
    <div class="page-wrapper compact-wrapper" id="pageWrapper"> @include('branch.includes.topbar')
      <!-- Page Body Start-->
      <div class="page-body-wrapper"> @include('branch.includes.sidebar') <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h3>Employee Detail</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a>
                        <i data-feather="home"></i>
                      </a>
                    </li>
                    <li class="breadcrumb-item">Employee</li>
                    <li class="breadcrumb-item active">Employee Detail</li>
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
                    <div class="cardheader" style="height:200px;"></div>
                    <div class="user-image">
                      <div class="avatar">
                        <img alt="" src="{{asset('storage/app/' . $employee_user->employee->image)}}">
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
                                <span>{{$employee_user->employee->email}}</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="ttl-info text-start">
                                <h6>
                                  <i class="fa fa-calendar"></i> SSN
                                </h6>
                                <span>{{$employee_user->employee->ssn}}</span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                          <div class="user-designation">
                            <div class="title">
                              <a target="_blank" href="#">{{$employee_user->employee->name}}</a>
                            </div>
                            <div class="desc">{{$employee_user->employee_branch->branch_number}}</div>
                          </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="ttl-info text-start">
                                <h6>
                                  <i class="fa fa-phone"></i> Contact Us
                                </h6>
                                <span>{{$employee_user->employee->contact}}</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="ttl-info text-start">
                                <h6>
                                  <i class="fa fa-location-arrow"></i> Location
                                </h6>
                                <span>{{$employee_user->employee->street}} {{$employee_user->employee->city}}
                                  {{$employee_user->employee->state}} {{$employee_user->employee->zip}}
                                  {{$employee_user->employee->country}}
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- user profile first-style end-->
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="container-fluid ">
                  <div class="page-title " style="padding-top:0px;">
                    <div class="row mt-4">
                      <div class="col-6">
                        <h3> Sales Record</h3>
                      </div>
                      <div class="col-6">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item">
                            <a>
                              <i data-feather="home"></i>
                            </a>
                          </li>
                          <li class="breadcrumb-item">Sales</li>
                          <li class="breadcrumb-item active"> View Sales</li>
                        </ol>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header">
                    <form class="theme-form" method="post" action="{{url('branch/employee_detail_sale_action')}}">
                         @csrf
                          <div class="row">
                        <div class="col-md-4 ">
                          <label class="d-block" for="chk-ani" style="color: #040d50;">From Date</label>
                          <input class="form-control" name="user_id" value="{{$employee_user->user_id}}" type="hidden" >

                          <input class="form-control" required name="from_date" type="date" placeholder="Sale Date">
                        </div>
                        <div class="col-md-4 ">
                          <label class="d-block" for="chk-ani" style="color: #040d50;">To Date</label>
                          <input class="form-control" required name="to_date" type="date">
                        </div>
                        <div class=" offset-md-2 col-md-2 mt-4">
                          <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                        </div>
                      </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            @if($record1 != null)
            <div class="row">
                     <div class="col-sm-12 col-xl-6 xl-100">
                        <div class="card">
                           <div class="card-body">
                            
                              <div class="tab-content" id="info-tabContent">
                                 <div class="tab-pane fade show active" id="info-home" role="tabpanel" aria-labelledby="info-home-tab">
                                    <div class="dt-ext table-responsive">
                                    <table class="display" id="responsive">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>Profiles</th>
                                       <th>Name</th>
                                       <th>Email</th>
                                       <th>Telephone</th>
                                       <th>Date</th>
                                       <th>Sales</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @php 
                                    $count =1;
                                    @endphp
                                    @foreach($record1 as $employee)
                                    <tr>
                                       <td>{{$count++}}</td>
                                       <td>
                                          <img src="{{asset('storage/app/'.$employee->employee_detail->image)}}" style=" border-radius: 50%; height: 70px; width: 70px;">
                                       </td>
                                       <td>{{$employee->employee_detail->name}}</td>
                                       <td>{{$employee->employee_detail->email}}</td>
                                       <td>{{$employee->employee_detail->contact}}</td>
                                       <td style="color:#040D50">  {{date('d/m/Y', strtotime($employee->date));}} </td>
                                       <td> $ {{$employee->sales}} </td>
                                    </tr>
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
                  @endif
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