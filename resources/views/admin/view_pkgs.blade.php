<!DOCTYPE html>
<html lang="en"> @include('admin.includes.head')
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
    <div class="page-wrapper compact-wrapper" id="pageWrapper"> @include('admin.includes.topbar')
      <!-- Page Body Start-->
      <div class="page-body-wrapper"> @include('admin.includes.sidebar') <div class="page-body">
          <div class="container-fluid">
            <div class="row">
              <!-- Individual column searching (text inputs) Starts-->
              <div class="page-title " style="padding-top:0px;">
                <div class="row ">
                  <div class="col-6">
                    <h3>View Packages</h3>
                  </div>
                  <div class="col-6">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a>
                          <i data-feather="home"></i>
                        </a>
                      </li>
                      <li class="breadcrumb-item">Packages</li>
                      <li class="breadcrumb-item active"> View Packages</li>
                    </ol>
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
                          <i class="fa fa-gift fa-md"></i>Packages </a>
                      </li>
                    </ul>
                    <div class="tab-content" id="info-tabContent">
                      <div class="tab-pane fade show active" id="info-home" role="tabpanel" aria-labelledby="info-home-tab">
                        <div class="dt-ext table-responsive">
                          <table class="display" id="responsive">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Package Title</th>
                                <th>Duration (Month)</th>
                                <th>Price</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            @php 
$count =1;
@endphp
                            
                            <tbody> @foreach($sub as $sub) <tr>
                              <td>{{$count++}}</td>
                                <td>{{$sub->name}}</td>
                                <td>{{$sub->months}}</td>
                                <td>${{$sub->price}}</td>
                                <td>
                                  <a class="btn-xs" data-bs-toggle="modal" data-bs-target="#hel{{$sub->id}}">
                                    <i class="fa fa-list fa-lg" style="color: green"></i>
                                  </a>
                                  <a class="btn-xs" data-bs-toggle="modal" data-bs-target="#helo{{$sub->id}}">
                                    <i class="fa fa-edit fa-lg" style="color: blue"></i>
                                  </a>
                                  <a class="btn-xs" href="{{url('admin/pkg_delete/'.$sub->id)}}" onClick="return confirm('Are you sure?')">
                                    <i class="fa fa-times-circle fa-lg" style="color: red"></i>
                                  </a>
                                </td>
                                <!-- Modal -->
                                <div class="modal fade " id="hel{{$sub->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title"> Packages Detail </h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <form class="card">
                                          <div class="card-body">
                                            <div class="row">
                                              <div class="col-md-6">
                                                <div class="mb-3">
                                                  <label class="float-start" for="recipient-name"> Package Title</label>
                                                  <input class="form-control" value="{{$sub->name}}" readonly>
                                                </div>
                                              </div>
                                              <div class="col-md-6">
                                                <div class="mb-3">
                                                  <label class="form-label">Duration(Month)</label>
                                                  <input class="form-control" value="{{$sub->months}}" readonly>
                                                </div>
                                              </div>
                                              <div class="col-md-6">
                                                <div class="mb-3">
                                                  <label class="form-label"> Price</label>
                                                  <input class="form-control" value="{{$sub->price}}" readonly>
                                                </div>
                                              </div>
                                              <div class="col-md-12">
                                                <div>
                                                  <label class="form-label"> Description</label>
                                                  <div> {!! htmlspecialchars_decode(nl2br($sub->description)) !!} </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </form>
                                      </div>
                                      <div class="modal-footer">
                                        <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- Modal End -->
                                <!--  Edit Employee Modal -->
                                <div class="modal fade " id="helo{{$sub->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title"> Edit Package Detail</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <form class="card" method="post" action="{{url('admin/edit_pkg_action')}}">
                                          @csrf
                                          <div class="card-body">
                                            <div class="row">
                                              <div class="col-md-6">
                                                <div class="mb-3">
                                                <input class="form-control" name="id" value="{{$sub->id}}" type="hidden">


                                                  <label class="float-start" for="recipient-name"> Package Title</label>
                                                  <input class="form-control" name="name" value="{{$sub->name}}" type="text">
                                                </div>
                                              </div>
                                              <div class="col-md-6">
                                                <div class="mb-3">
                                                  <label class="form-label">Duration(Month)</label>
                                                  <input class="form-control" name="month" value="{{$sub->months}}" type="text">
                                                </div>
                                              </div>
                                              <div class="col-md-6">
                                                <div class="mb-3">
                                                  <label class="form-label"> Price</label>
                                                  <input class="form-control" value="{{$sub->price}}" name="price" type="text">
                                                </div>
                                              </div>

                                              <div class="row mt-3">
                                              <div class="col-md-12">
                                                    <label class="form-label">Description:</label>
                                                    <textarea name="description" rows="5" id="{{$sub->id}}" class="standard-editor"> {{$sub->description}}</textarea>
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
                              </tr> @endforeach </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Individual column searching (text inputs) Ends-->
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start--> @include('admin.includes.footer') </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>
    <script src="{{asset('public/assets/js/tinymce/tinymce.min.js')}}"></script>
    <!-- login js-->
    <!-- Plugin used-->
    <script>
      $('#hi').delay(2000).slideUp(1200);
    </script>
    <script type="text/javascript">
      $('#datatable_page').dataTable({
        "pageLength": 25,
        "order": [
          [1, "desc"]
        ]
      });
    </script>

<script>

tinymce.init({
        selector: '.standard-editor',
      });
   </script>

  

   </script> @if (session('message')) <script>
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Successfully Edit ',
        showConfirmButton: false,
        timer: 2500
      })
    </script> @endif

@if (session('delete'))
 <script>
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Successfully Delete ',
        showConfirmButton: false,
        timer: 2500
      })
    </script> @endif

@if (session('error'))
 <script>
      Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'you can not delete the package',
})
    </script> @endif

    
  </body>
  <!-- Mirrored from admin.pixelstrap.com/cuba/theme/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 27 Apr 2021 09:50:21 GMT -->
</html>