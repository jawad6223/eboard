<!DOCTYPE html>
<html lang="en">
  <head></head> @include('admin.includes.head') <body>
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
    <div class="page-wrapper compact-wrapper" id="pageWrapper"> @include('admin.includes.topbar')
      <!-- Page Body Start-->
      <div class="page-body-wrapper"> @include('admin.includes.sidebar') <div class="page-body">
          <div class="container-fluid ">
            <div class="page-title " style="padding-top:0px;">
              <div class="row mt-4">
                <div class="col-6">
                  <h3>Add New Business</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a>
                        <i data-feather="home"></i>
                      </a>
                    </li>
                    <li class="breadcrumb-item">Business</li>
                    <li class="breadcrumb-item active"> Add New Business</li>
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
                    <form class="theme-form" action="{{url('admin/addbusinessaction')}}" method="post" enctype="multipart/form-data">
                       @csrf
                        <div class="row"> @error('company_name') <div class="alert alert-danger mb-2" id="hi" role="alert">
                          {{$message}}
                        </div>
                         @enderror @error('company_name1') 
                         <div class="alert alert-danger mb-2" id="hi" role="alert">
                          {{$message}}
                        </div>
                         @enderror 

                         
                         @error('company_logo') 
                         <div class="alert alert-danger mb-2" id="hi" role="alert">
                          {{$message}}
                        </div>
                         @enderror 
                        
                        <div class="col-md-6 ">
                          <select class="js-example-basic-single col-sm-12" name="company_name1">
                            <option value="">Select Company</option>
                             @foreach($company as $company) 
                             <option value="{{$company->id}}">
                               {{$company->name}}
                              
                              </option>
                                @endforeach
                          </select>
                        </div>
                        <div class="col-md-1 mt-2">
                          <label class="d-block" for="chk-ani" style="color: #040d50;"> OR </label>
                        </div>
                        <div class="col-md-4 mt-2">
                          <label class="d-block" for="chk-ani">
                            <input class="checkbox_animated" id="add_company" type="checkbox" value="1" onchange="company_toggle()"> Add New Company </label>
                        </div>
                      </div>
                      <div id="company_div" class="mb-2" style="display: none;">
                        <div class="row mt-4 ">
                          <div class="col-md-12  mb-2">
                            <h3> Add Company Info: </h3>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-md-4 ">
                            <input class="form-control" name="company_name" type="text" placeholder="Company Name">
                          </div>
                          <div class="col-md-4 ">
                            <input class="form-control" name="company_email" type="email" placeholder="Company Email">
                          </div>
                          <div class="col-md-4 ">
                            <input class="form-control" id="company_phone" name="company_contact" type="tel" placeholder="Company Phone">
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-md-4 ">
                            <input class="form-control" id="company_website" name="company_website" type="url" placeholder="Company Website URL">
                          </div>
                          <div class="col-md-4 ">
                            <input class="form-control" id="ein" name="company_ein" type="text" placeholder="Company EIN">
                          </div>
                        </div>
                        <div class="row mt-3">
                         
                          <div class="col-md-4 "> Company Creation Date: <input class="form-control" id="company_date" name="company_date" type="date" placeholder="Company Creation Date">
                          </div>
                          <div class="col-md-4 "> Company Logo: <input class="form-control" name="company_logo" type="file" data-bs-original-title title >
                          </div>
                        </div>
                        <div class="row mt-3">
                          <div class="col-md-8 ">
                            <input class="form-control" id="company_address" name="company_street" type="text" placeholder="Street Address">
                          </div>
                          <div class="col-md-4 ">
                            <input class="form-control" id="company_city" name="company_city" type="text" placeholder="City">
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-md-4 ">
                            <input class="form-control" id="company_state" name="company_state" type="text" placeholder="State">
                          </div>
                          <div class="col-md-4 ">
                            <input class="form-control" id="company_zip" name="company_zip" type="number" placeholder="Zip">
                          </div>
                          <div class="col-md-4 ">
                            <input class="form-control" id="company_country" name="company_country" type="text" placeholder="Country">
                          </div>
                        </div>
                      </div>
                      <div id="branch_div" class="mt-4 mb-2">
                        <div class="row mt-4 ">
                          <div class="col-md-12  mb-2">
                            <h3> Add Branch Info: </h3>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-md-4 ">
                           
                          <input class="form-control" required id="branch_code" name="branch_number" type="text" placeholder="Branch Code">
                          @error('branch_number')
                      <span class="text-danger">
                      {{$message}}
                      </span>
                    @enderror  
                        </div>
                          <div class="col-md-4 ">
                            <input class="form-control" required id="branch_email" name="email" type="email" placeholder="Branch Email">
                            @error('email')
                      <span class="text-danger">
                      {{$message}}
                      </span>
                    @enderror
                          </div>
                          <div class="col-md-4 ">
                            <input class="form-control" required id="company_phone" name="branch_contact" type="tel" placeholder="Branch Phone">
                          </div>
                        </div>
                        <div class="row mt-3">
                          <div class="col-md-4 ">
                            <input class="form-control" required id="branch_address" name="branch_street" type="text" placeholder="Street Address">
                          </div>
                          <div class="col-md-4 ">
                            <input class="form-control" required id="branch_city" name="branch_city" type="text" placeholder="City">
                          </div>
                          <div class="col-md-4 ">
                            <input class="form-control" required id="branch_state" name="branch_state" type="text" placeholder="State">
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-md-4 ">
                            <input class="form-control" required id="branch_zip" name="branch_zip" type="number" placeholder="Zip">
                          </div>
                          <div class="col-md-4 ">
                            <input class="form-control" required id="branch_country" name="branch_country" type="text" placeholder="Country">
                          </div>
                          <div class="col-md-4 mt-3">
                            <label class="d-block" for="chk-ani">
                              <input class="checkbox_animated" id="add_company" name="is_headquater" type="checkbox" value="1"> Is Headquarter </label>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMlR4YuYz3KMPmTmOXSwQc7p6IS-a19Bs&callback=myMap"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>
    <script>
      $('#hi').delay(2000).slideUp(1200);
    </script>
    <!---On add company form-->
    <script type="text/javascript">
      function company_toggle() {
        if ($('#add_company').is(":checked"))
          // console.log("edawd");   
          $("#company_div").show();
        else $("#company_div").hide();
      }
    </script> @if (session('message')) <script>
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Successfully Added ',
        showConfirmButton: false,
        timer: 2500
      })
    </script> @endif

@if (session('message3')) <script>
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Headquarter Allready Exist ',
        showConfirmButton: false,
        timer: 2500
      })
    </script> @endif


<script src="{{asset('public/assets/input-mask.js')}}"></script>
    <script src="{{asset('public/assets/jquery.inputmask.bundle.min.js')}}"></script>
    <script>
      $("#ein").inputmask("99-9999999");
    </script>

  </body>
</html>