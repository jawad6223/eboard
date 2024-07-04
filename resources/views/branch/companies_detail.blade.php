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
                  <h3>Company Detail</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a>
                        <i data-feather="home"></i>
                      </a>
                    </li>
                    <li class="breadcrumb-item">Companies</li>
                    <li class="breadcrumb-item active">Company Detail</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts--> 
          @php
           $count= 0;
            $count1= 0; 
            @endphp
             @foreach($company->company_branches as $total)
              @php 
              $count = $count + count($total->branch_employee);
               $count1 = $count1 + $total->branch_reward->where('status',1)->count();
                @endphp 
               
               @endforeach 
               <div class="container-fluid">
            <div class="user-profile">
              <div class="row">
                <!-- user profile first-style start-->
                <div class="col-sm-12">
                  <div class="card hovercard text-center">
                    <div class="cardheader"></div>
                    <div class="user-image">
                      <div class="avatar">
                        <img alt="" src="{{asset('storage/app/' . $company->logo)}}" style="width:110px;height:110px">
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
                                <span>{{$company->email}}</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="ttl-info text-start">
                                <h6>
                                  <i class="fa fa-calendar"></i> Website URL
                                </h6>
                                <span>{{$company->website}}</span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                          <div class="user-designation">
                            <div class="title">
                              <a target="_blank" href="#">{{$company->name}}</a>
                            </div>
                            <div class="desc">{{$company->ein}}</div>
                          </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="ttl-info text-start">
                                <h6>
                                  <i class="fa fa-phone"></i> Contact Us
                                </h6>
                                <span>{{$company->contact}}</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="ttl-info text-start">
                                <h6>
                                  <i class="fa fa-location-arrow"></i> Location
                                </h6>
                                <span>
                                {{$company->street}}, {{$company->city}},{{$company->state}},{{$company->zip}},{{$company->country}}</span>
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
                          <i class="fa fa-building fa-2x"></i>
                        </div>
                        <div class="media-body">
                          <span class="m-0"> Total Branches</span>
                          <h4 class="mb-0 counter">
                            {{count($company->company_branches)}}
                          </h4>
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
                          <i data-feather="users"></i>
                        </div>
                        <div class="media-body">
                          <span class="m-0"> Total Employees</span>
                          <h4 class="mb-0 counter">{{$count}}</h4>
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
                          <h4 class="mb-0 counter">{{$count1}}</h4>
                          </i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-3">

            @foreach($company->company_branches as $business)

              <div class="col-xl-4 box-col-6">
                <div class="card custom-card">
                  <div class="card-header">
                    <img class="img-fluid" src="{{asset('public/assets/images/user-card/3.jpg')}}"  alt="">
                  </div>
                  <div class="card-profile">
                    <img class="rounded-circle" src="{{asset('storage/app/' . $company->logo)}}"  style="width:110px;height:110px" alt="">
                  </div>
                  <div class="text-center profile-details">
                    <h4>{{$company->name}}</h4>
                    <p>{{$business->branch_number}}</p>
                  </div>
                  <div class="card-footer row">
                    <div class="col-6 ">
                      <h5>Email</h5>
                      <p class="counter">{{$business->email}}</p>
                    </div>
                    <div class="col-6">
                      <h5>Address</h5>
                      <p class="counter">  {{$business->street}}, {{$business->city}},{{$business->state}},{{$business->zip}},{{$business->country}}</p>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
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
    <script src="https://use.fontawesome.com/43c99054a6.js"></script>
    <script src="{{asset('public/assets/js/script.js')}}"></script>
    <script src="{{asset('public/assets/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('public/assets/js/select2/select2-custom.js')}}"></script>
    <script>
      $('#hi').delay(2000).slideUp(1200);
    </script>
  </body>
</html>