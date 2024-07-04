<!DOCTYPE html>
<html lang="en">
    @include('branch.includes.head') <body>
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
      <div class="page-body-wrapper"> 
         @include('branch.includes.sidebar')

          <div class="page-body">
          <div class="container-fluid ">
            <div class="page-title " style="padding-top:0px;">
              <div class="row mt-4">
                <div class="col-6">
                  <h3>Add Sale Record</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a>
                        <i data-feather="home"></i>
                      </a>
                    </li>
                    <li class="breadcrumb-item">Sales</li>
                    <li class="breadcrumb-item active"> Add Record</li>
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
                    <form class="theme-form" method="post" action="{{url('branch/add_sale_action')}}"> @csrf <div class="row mb-2">
                        <div class="col-md-6 mt-1">
                          <select class="js-example-basic-single col-sm-12" required name="business_id">
                            <option value="">Select Business </option> @foreach($business as $business) <option value="{{$business->id}}">
                              {{$business->branch_company->name}} - {{$business->branch_number}}
                            </option> @endforeach
                          </select>
                        </div>
                        <div class="col-md-3 ">
                          <input class="form-control" required id="branch_code" name="date" type="date" placeholder="Sale Date">
                        </div>
                        <div class="col-md-2 mt-2">
                          <button class="btn btn-primary " name="submit" type="submit">Submit</button>
                        </div>
                      </div>
                  </div>
                  </form>
                </div>
              </div>
            </div> @if($employees != null) <div class="row">
              <div class="col-sm-12 col-xl-12 xl-100">
                <div class="card">
                  <div class="card-body">
                    <ul class="nav nav-tabs border-tab nav-primary" id="info-tab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="info-home-tab" data-bs-toggle="tab" href="#info-home" role="tab" aria-controls="info-home" aria-selected="true">
                          <i class="fa fa-users  fa-md"></i>Employees <span style="color:#f49f1c;">
                            {{ date('m/d/Y', strtotime($date));}}
                          </span>
                        </a>
                      </li>
                    </ul>
                    <div class="tab-content" id="info-tabContent">
                      <div class="tab-pane fade show active" id="info-home" role="tabpanel" aria-labelledby="info-home-tab">
                         @foreach($employees as $employees)
                          <form class="theme-form" method="post" action="{{url('branch/add_employee_sale_action')}}">
                             @csrf
                            

                              <input name="branch_id[]" type="hidden" value="{{$employees->branch_id}}">
                          <input name="user_id[]" type="hidden" value="{{$employees->user_id}}">
                          <input name="date[]" type="hidden" value="{{$date}}">
                          <div class="row mb-2">
                            <div class="col-md-2">
                              <img src="{{asset('storage/app/'.$employees->employee->image)}}" style=" border-radius: 50%; height: 70px; width: 70px;">
                            </div>
                            <div class="col-md-3 mt-2">
                              <label class="d-block" for="chk-ani" style="color: #040d50;">{{$employees->employee->name}}</label>
                            </div>
                            <div class="col-md-3 mt-2">
                              <label class="d-block" for="chk-ani" style="color: #040d50;">{{$employees->employee->email}}</label>
                            </div>
                            <div class="col-md-3 ">
                           

                              <input class="form-control" required id="branch_email" name="sale[]" type="number" 
                            
                               
                              value="{{$employees->sales}}" placeholder="Enter Sale">
                            </div>
                         
                          </div>
                          <hr> @endforeach <div class=" mt-2  text-end">
                            <button class="btn btn-primary  " name="submit" type="submit">Submit</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> @endif
          </div>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>
    <script>
      $('#hi').delay(2000).slideUp(1200);
    </script>

@if (session('message'))
  <script>
Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Successfully Added',
  showConfirmButton: false,
  timer: 2500
})
</script>            
   @endif

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

  </body>
</html>