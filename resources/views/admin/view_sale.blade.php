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
               <!-- Container-fluid starts-->
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="card">
                           <div class="card-header">
                              <form class="theme-form" method="post" action="{{url('admin/view_sale_action')}}">
                                 @csrf
                                 <div class="m-t-15 m-checkbox-inline custom-radio-ml">
                                    <div class="form-check form-check-inline radio radio-primary">
                                       <input class="form-check-input" id="radioinline1" type="radio" checked name="business" value="business" data-bs-original-title="" title="">
                                       <label class="form-check-label mb-0" for="radioinline1">Business <span class="digits"> Sales</span>
                                       </label>
                                    </div>
                                    <div class="form-check form-check-inline radio radio-primary">
                                       <input class="form-check-input" id="radioinline2" type="radio" name="business" value="employee" data-bs-original-title="" title="">
                                       <label class="form-check-label mb-0" for="radioinline2">Employess <span class="digits"> Sales</span>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="box row mb-2 mt-4" id="business">
                                    <div class="col-md-4 ">
                                       <label class="d-block" for="chk-ani" style="color: #040d50;">Select Business</label>
                                       <select class="js-example-basic-single col-sm-12"  name="business_id">
                                          <option value="">View Business Sale</option>

                                          
                                    
                                          @foreach($business as $business)
                                          <option value="{{$business->id}}"> {{$business->branch_company->name}} - {{$business->branch_number}}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                    <div class="col-md-3 ">
                                       <label class="d-block" for="chk-ani" style="color: #040d50;">From Date</label>
                                       <input class="form-control" name="start_date"  type="date" placeholder="Sale Date">
                                    </div>
                                    <div class="col-md-3 ">
                                       <label class="d-block" for="chk-ani" style="color: #040d50;">To Date</label>
                                       <input class="form-control" name="end_date"  type="date" >
                                    </div>
                                 </div>
                                 <div class="box row mb-2 mt-4" id="employee" style="display: none;">
                                    <div class="col-md-4 ">
                                       <label class="d-block" for="chk-ani" style="color: #040d50;">Select Employee</label>
                                       <select class="js-example-basic-single col-sm-12"  name="employee_id">
                                          <option value="">View Employee </option>
                                          @foreach($business1 as $business)
                                          @foreach($business->branch_employee as $employees)
                                          <option value="{{$employees->user_id}}">{{$employees->employee->name}}</option>
                                          @endforeach
                                          @endforeach
                                       </select>
                                    </div>
                                    <div class="col-md-3 ">
                                       <label class="d-block" for="chk-ani" style="color: #040d50;">From Date</label>
                                       <input class="form-control" name="from_date"  type="date" placeholder="Sale Date">
                                    </div>
                                    <div class="col-md-3 ">
                                       <label class="d-block" for="chk-ani" style="color: #040d50;">To Date</label>
                                       <input class="form-control" name="to_date"  type="date" >
                                    </div>
                                 </div>
                                 <div class="row mb-2 mt-2">
                                    <div class="col-md-10"></div>
                                    <div class="col-md-2 mt-4">
                                       <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                                    </div>
                                 </div>
                           </div>
                           </form>
                        </div>
                     </div>
                  </div>
                
           
                  @if($record != null)
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
                                                <th>Email</th>
                                                <th>Telephone</th>
                                                <!-- <th>Date</th> -->
                                                <th>Sales</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             @php 
                                             $count =1;
                                             @endphp
                                             @foreach($record as $employee)
                                             <tr>
                                                <td>{{$count++}}</td>
                                                <td>
                                                   <img src="{{asset('storage/app/'.$employee->employee_detail->image)}}" style=" border-radius: 50%; height: 70px; width: 70px;">
                                                </td>
                                                <td>{{$employee->employee_detail->name}}</td>
                                                <td>{{$employee->employee_detail->email}}</td>
                                                <td>{{$employee->employee_detail->contact}}</td>
                                                <!-- <td style="color:#040D50">  {{date('d/m/Y', strtotime($employee->date));}} </td> -->
                                                <td> $ {{$employee->sum}} </td>
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

                  @if($record1 != null)
                  <div class="col-sm-12">
                     <div class="card">
                        
                        <div class="card-body">
                        <ul class="nav nav-tabs border-tab nav-primary" id="info-tab" role="tablist">
                                 <li class="nav-item">
                                    <a class="nav-link active" id="info-home-tab" data-bs-toggle="tab" href="#info-home" role="tab" aria-controls="info-home" aria-selected="true">
                                    <i class="fa fa-user fa-md"></i>Employees </a>
                                 </li>
                              </ul>
                           <div class="table-responsive">
                              <table id="example-style-2">
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
                  @endif
               </div>
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
      <script src="{{asset('public/assets/js/sidebar-menu.js')}}"></script>
      <script src="{{asset('public/assets/js/chart/apex-chart/moment.min.js')}}"></script>
      <script src="{{asset('public/assets/js/chart/apex-chart/apex-chart.js')}}"></script>
      <script src="{{asset('public/assets/js/chart/apex-chart/stock-prices.js')}}"></script>
      <script src="{{asset('public/assets/js/prism/prism.min.js')}}"></script>
      <script src="{{asset('public/assets/js/clipboard/clipboard.min.js')}}"></script>
      <script src="{{asset('public/assets/js/counter/jquery.waypoints.min.js')}}"></script>
      <script src="{{asset('public/assets/js/counter/jquery.counterup.min.js')}}"></script>
      <script src="{{asset('public/assets/js/counter/counter-custom.js')}}"></script>
      <script src="{{asset('public/assets/js/custom-card/custom-card.js')}}"></script>
      <!-- <script src="{{asset('public/assets/js/chart-widget.js')}}"></script> -->
      <script src="{{asset('public/assets/js/tooltip-init.js')}}"></script>
      <!-- Theme js-->
      <script src="{{asset('public/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatables/datatable.custom.js')}}"></script>
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
      <script>
         $('#hi').delay(2000).slideUp(1200);
      </script>
      <script>
         $(document).ready(function() {
           $('input[type="radio"]').click(function() {
             var inputValue = $(this).attr("value");
             var targetBox = $("#" + inputValue);
             $(".box").not(targetBox).hide();
             $(targetBox).show();
           });
         });
      </script>
      <script>
         var optionsturnoverchart = {
           chart: {
             height: 320,
             type: 'area',
             zoom: {
               enabled: false
             }
           },
           dataLabels: {
             enabled: false
           },
           stroke: {
             curve: 'straight'
           },
           fill: {
             colors: [CubaAdminConfig.primary],
             type: 'gradient',
             gradient: {
               shade: 'light',
               type: 'vertical',
               shadeIntensity: 0.4,
               inverseColors: false,
               opacityFrom: 0.9,
               opacityTo: 0.8,
               stops: [0, 100]
             }
           },
           series: [{
             name: "Sales",
             data: series.monthDataSeries1.prices
           }],
           title: {
             text: 'Fundamental Analysis of Stocks',
             align: 'left'
           },
           colors: [CubaAdminConfig.primary],
           labels: series.monthDataSeries1.dates,
           xaxis: {
             type: 'datetime'
           },
           yaxis: {
             opposite: false
           },
           legend: {
             horizontalAlign: 'left'
           }
         }
         var chartturnoverchart = new ApexCharts(document.querySelector("#chart-widget7"), optionsturnoverchart);
         chartturnoverchart.render();
      </script>
   </body>
</html>
x