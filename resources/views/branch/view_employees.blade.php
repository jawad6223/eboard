<!DOCTYPE html>
<html lang="en">
   @include('branch.includes.head')
   <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/vendors/datatables.css')}}">
   <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
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
               <div class="row">
                  <!-- Individual column searching (text inputs) Starts-->
                  <div class="page-title " style="padding-top:0px;">
                     <div class="row ">
                        <div class="col-6">
                           <h3>View Employees</h3>
                        </div>
                        <div class="col-6">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item">
                                 <a>
                                 <i data-feather="home"></i>
                                 </a>
                              </li>
                              <li class="breadcrumb-item">Employees</li>
                              <li class="breadcrumb-item active"> View Employees</li>
                           </ol>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="card">
                        <div class="card-body">
                           <form class="theme-form" method="post" action="{{url('branch/employee_show_action')}}">
                              @csrf 
                              <div class="row mb-2">
                                 <div class="col-sm-8 ">
                                    <select class="js-example-basic-single col-sm-12" required name="business_id">
                                       <option value="">Select Business</option>
                                       @foreach($business as $business) 
                                       <option value="{{$business->id}}">
                                          {{$business->branch_company->name}} - {{$business->branch_number}}
                                       </option>
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="col-sm-2 offset-md-2 mt-1">
                                    <button class="btn btn-primary " type="submit">Show</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
</div>
@if($employees_user != null)
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
                                       @error('email') 
                                       <div class="alert alert-danger mb-2" id="hi" role="alert">
                                          {{$message}}
                                       </div>
                                       @enderror @error('ssn') 
                                       <div class="alert alert-danger mb-2" id="hi" role="alert">
                                          {{$message}}
                                       </div>
                                       @enderror @error('image') 
                                       <div class="alert alert-danger mb-2" id="hi" role="alert">
                                          {{$message}}
                                       </div>
                                       @enderror 
                                       <table class="display" id="responsive">
                                          <thead>
                                             <tr>
                                                <th>#</th>
                                                <th>Profiles</th>
                                                <th>Company Name</th>
                                                <th>Branch Code</th>
                                                <th>Employee Name</th>
                                                <th>Telephone</th>
                                                <th>SSN</th>
                                                <th>Action</th>
                                             </tr>
                                          </thead>
                                          @php $count=1; @endphp 
                                          <tbody>
                                             @foreach($employees_user as $employee_user) 
                                             <tr>
                                                <td>{{$count++}}</td>
                                                <td>
                                                   <img src="{{asset('storage/app/' . $employee_user->employee->image)}}" style=" border-radius: 50%; height: 70px; width: 70px;">
                                                </td>
                                                <td>{{$employee_user->employee_branch->branch_company->name}}</td>
                                                <td>{{$employee_user->employee_branch->branch_number}}</td>
                                                <td>{{$employee_user->employee->name}}</td>
                                                <td>{{$employee_user->employee->contact}}</td>
                                                <td>{{$employee_user->employee->ssn}}</td>
                                                <td>
                                                   <a class="btn-xs" href="{{url('branch/employee_detail/'.$employee_user->user_id)}}">
                                                   <i class="fa fa-list fa-lg" style="color: green"></i>
                                                   </a>
                                                   <a class="btn-xs" data-bs-toggle="modal" data-bs-target="#hel{{$employee_user->user_id}}">
                                                   <i class="fa fa-edit fa-lg" style="color: blue"></i>
                                                   </a>
                                                   <a class="btn-xs" href="{{url('branch/employee_delete/'.$employee_user->user_id)}}" onClick="return confirm('Are you sure?')">
                                                   <i class="fa fa-times-circle fa-lg" style="color: red"></i>
                                                   </a>
                                                 
                                                   <!--  Edit Employee Modal -->
                                                   <div class="modal fade " id="hel{{$employee_user->user_id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog modal-lg">
                                                         <div class="modal-content">
                                                            <div class="modal-header">
                                                               <h5 class="modal-title"> Edit Employee Detail </h5>
                                                               <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                               <form class="card" method="post" action="{{url('branch/edit_employee_action')}}" enctype="multipart/form-data">
                                                                  @csrf 
                                                                  <div class="card-body">
                                                                     <div class="row">
                                                                        <div class="col-md-6">
                                                                           <div class="mb-3">
                                                                              <input class="form-control" name="id" value="{{$employee_user->employee->id}}" type="hidden">
                                                                              <label class="float-start" for="recipient-name"> Name</label>
                                                                              <input class="form-control" name="name" value="{{$employee_user->employee->name}}" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                           <div class="mb-3">
                                                                              <label class="float-start" for="recipient-name"> Email</label>
                                                                              <input class="form-control" type="text" name="email" value="{{$employee_user->employee->email}}">
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
                                                                              <input class="form-control" id="ssn" name="ssn" value="{{$employee_user->employee->ssn}}" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                           <div class="mb-3">
                                                                              <label class="form-label">Contact</label>
                                                                              <input class="form-control" name="contact" value="{{$employee_user->employee->contact}}" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                           <div class="mb-3">
                                                                              <label class="form-label">Street Address</label>
                                                                              <input class="form-control" name="street" value="{{$employee_user->employee->street}}" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                           <div class="mb-3">
                                                                              <label class="form-label">City</label>
                                                                              <input class="form-control" name="city" value="{{$employee_user->employee->name}}" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                           <div class="mb-3">
                                                                              <label class="form-label">State</label>
                                                                              <input class="form-control" name="state" value="{{$employee_user->employee->state}}" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                           <div class="mb-3">
                                                                              <label class="form-label">Zip Code</label>
                                                                              <input class="form-control" name="zip" value="{{$employee_user->employee->zip}}" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                           <div class="mb-3">
                                                                              <label class="form-label">Country</label>
                                                                              <input class="form-control" name="country" value="{{$employee_user->employee->country}}" type="text">
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                     <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                                                                     <button class="btn btn-primary" type="submit">Update</button>
                                                                  </div>
                                                               </form>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <!-- Modal End -->
                                                </td>
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
                  <!-- Individual column searching (text inputs) Ends-->
               </div>
               <!-- Container-fluid Ends-->
            </div>
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
      <script src="{{asset('public/assets/js/notify/bootstrap-notify.min.js')}}"></script>
      <script src="{{asset('public/assets/js/select2/select2.full.min.js')}}"></script>
      <script src="{{asset('public/assets/js/select2/select2-custom.js')}}"></script>
      <!-- Plugins JS Ends-->
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
      <!-- login js-->
      <!-- Plugin used-->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script> @if (session('message1')) <script>
         Swal.fire({
           position: 'top-end',
           icon: 'success',
           title: 'Successfully Updated ',
           showConfirmButton: false,
           timer: 2500
         })
      </script> @endif <script>
         $('#hi').delay(2000).slideUp(1200);
      </script>
      <script type="text/javascript">
         $('#datatable_page').dataTable({
           "pageLength": 25,
           "order": [
             [1, "desc"]
           ]
         });
      </script> @if (session('delete')) <script>
         Swal.fire({
           position: 'top-end',
           icon: 'success',
           title: 'Successfully Delete ',
           showConfirmButton: false,
           timer: 2500
         })
      </script> @endif <script src="{{asset('public/assets/input-mask.js')}}"></script>
      <script src="{{asset('public/assets/jquery.inputmask.bundle.min.js')}}"></script>
      <script>
         $("#ssn").inputmask("999-99-9999");
      </script>
   </body>
   <!-- Mirrored from admin.pixelstrap.com/cuba/theme/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 27 Apr 2021 09:50:21 GMT -->
</html>