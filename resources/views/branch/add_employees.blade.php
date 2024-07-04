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
    <div class="page-wrapper compact-wrapper" id="pageWrapper"> @include('branch.includes.topbar')
      <!-- Page Body Start-->
      <div class="page-body-wrapper"> @include('branch.includes.sidebar') <div class="page-body">
          <div class="container-fluid ">
            <div class="page-title " style="padding-top:0px;">
              <div class="row mt-4">
                <div class="col-6">
                  <h3>Add New Employee</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a>
                        <i data-feather="home"></i>
                      </a>
                    </li>
                    <li class="breadcrumb-item">Employee</li>
                    <li class="breadcrumb-item active"> Add New Employee</li>
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
                    <form class="theme-form" method="post" action="{{url('branch/add_employee_action')}}">
                       @csrf
                      <div class="row">
                        <div class="col-md-6 ">
                          <select class="js-example-basic-single col-sm-12" required name="branch_id">
                            <option value="">Select Business</option> 
                            @foreach($business as $business)
                             <option value="{{$business->id}}"> {{$business->branch_company->name}} - {{$business->branch_number}}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                      <div id="branch_div" class="mt-4 mb-2">
                        <div class="row mt-4 ">
                          <div class="col-md-12  mb-2">
                            <h5> Add Employee Info: </h5>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-md-4 ">
                            <input class="form-control" required id="branch_code" name="name" type="text" placeholder="Full Name">
                          </div>
                          <div class="col-md-4 ">
                            <input class="form-control" id="branch_email" name="email" type="email" placeholder="Email">
                            @error('email')
                      <span class="text-danger">
                      {{$message}}
                      </span>
                    @enderror
                          </div>
                          <div class="col-md-4 ">
                            <input class="form-control"  id="company_phone" name="contact" type="tel" placeholder="Phone">
                          </div>
                        </div>
                        <div class="row mt-3">
                        <div class="col-md-4 ">
                        <p class='num'>
                        <input class="form-control"  id="ssn" name="ssn" type="text"  placeholder="SSN">
                      
                        @error('ssn')
                      <span class="text-danger">
                      {{$message}}
                      </span>
                    @enderror   
                     </div>

                          <div class="col-md-4 ">
                            <input class="form-control"  id="branch_address" name="street" type="text" placeholder="Street Address">
                          </div>
                          
                          <div class="col-md-4 ">
                            <input class="form-control"  id="branch_city" name="city" type="text" placeholder="City">
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-md-4 ">
                            <input class="form-control"  id="branch_state" name="state" type="text" placeholder="State">
                          </div>
                          <div class="col-md-4 ">
                            <input class="form-control"  id="branch_zip" name="zip" type="number" placeholder="Zip">
                          </div>
                          <div class="col-md-4 ">
                            <input class="form-control"  id="branch_country" name="country" type="text" placeholder="Country">
                          </div>
                        </div>
                      </div>
                      <div class="card-footer text-end">
                        <button class="btn btn-primary " name="submit" type="submit">Submit</button>
                      </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>
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
    </script> 
    @if (session('message')) 
    <script>
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Successfully Added ',
        showConfirmButton: false,
        timer: 2500
      })
    </script>
     @endif

    <script src="{{asset('public/assets/input-mask.js')}}"></script>
    <script src="{{asset('public/assets/jquery.inputmask.bundle.min.js')}}"></script>
    <script>
      $("#ssn").inputmask("999-99-9999");
    </script>
  </body>
</html>