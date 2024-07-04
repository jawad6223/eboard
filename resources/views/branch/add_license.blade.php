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
          <div class="container-fluid ">
            <div class="page-title " style="padding-top:0px;">
              <div class="row mt-4">
                <div class="col-6">
                  <h3>Add Certificate/License</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a>
                        <i data-feather="home"></i>
                      </a>
                    </li>
                    <li class="breadcrumb-item">Certificate</li>
                    <li class="breadcrumb-item active"> Add New Certificate</li>
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
                    <form class="theme-form" method="post" action="{{url('branch/add_license_action')}}"> @csrf <div class="row"></div>
                      <div id="branch_div" class="mt-4 mb-2">
                        <div class="row mt-2">
                         
                          <div class="col-md-5 ">
                            <select class="js-example-basic-single col-sm-12" required name="license_name">
                              <option value="">Select License Name</option>
                               @foreach($license as $license) 
                               <option value="{{$license->id}}">{{$license->name}}</option> @endforeach
                            </select>
                          </div>
                          <div class="col-md-5 ">
                            <select class="js-example-basic-single col-sm-12" required name="org_name">
                              <option value="">Select Organization</option> @foreach($org as $org) <option value="{{$org->id}}">{{$org->name}}</option> @endforeach
                            </select>
                          </div>
                        </div>
                       
                       
                        <div id="" class="row mt-4">
                          <div class="col-md-2 mt-2 ">
                            <label>License Number</label>
                          </div>

                          <div class="col-md-3 ">
                            <input class="form-control" required id="branch_code" name="number" type="text" placeholder="License Number">
                          </div>

                        
                          <div class="col-md-2 mt-2 ">
                            <label>Credential ID: </label>
                          </div>

                          <div class="col-md-3 ">
                            <input class="form-control" required id="branch_state" name="credential_id" type="text" placeholder="Credential ID">
                          </div>

                         
                        </div>

                        <div id="" class="row mt-4">
                          <div class="col-md-2 mt-2 ">
                            <label>Credential URL:</label>
                          </div>
                          <div class="col-md-3 ">
                            <input class="form-control" required id="branch_zip" name="url" type="url" placeholder="Credential URL">
                          </div>

                          <div class="col-md-2 mt-2 ">
                            <label>Issue Date:</label>
                          </div>
                          <div class="col-md-3 ">
                            <input class="form-control" id="branch_state" name="start_date" type="date" placeholder="Start Date">
                          </div>
                        </div>

                        <div class="row mt-3">
                          <div class="col-md-4 mt-2">
                            <label class="d-block" for="chk-ani">
                              <input class="checkbox_animated" id="date_check" type="checkbox" value="1" onchange="expire_toggle()">This credential does not expire. </label>
                          </div>
                        </div>

                        <div class="row mt-2 " id="date_div">
                         
                        
                         <div class="col-md-2 mt-2 ">
                           <label>Expire Date:</label>
                         </div>
                         <div class="col-md-3 ">
                           <input class="form-control" id="branch_zip" name="end_date" type="date" placeholder="Close Date">
                         </div>
                       
                     </div>

                      </div>
                      <div class="card-footer text-end">
                        <button class="btn btn-primary " type="submit">Submit</button>
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
    <script>
      $('#hi').delay(2000).slideUp(1200);
    </script>
    <script type="text/javascript">
      function expire_toggle() {
        if ($('#date_check').is(":checked"))
          // console.log("edawd");   
          $("#date_div").hide();
        else $("#date_div").show();
      }
    </script> @if (session('message')) <script>
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Successfully Added',
        showConfirmButton: false,
        timer: 2500
      })
    </script> @endif
  </body>
</html>