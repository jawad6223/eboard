<!DOCTYPE html>
<html lang="en">
   <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/vendors/datatables.css')}}">
   @include('branch.includes.head')
   <body>
      <div class="loader-wrapper">
         <div class="loader-index"><span></span></div>
         <svg>
            <defs></defs>
            <filter id="goo">
               <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
               <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
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
                           <h3>Welcome Back</h3>
                        </div>
                        <div class="col-6">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a>  
                              <i data-feather="home"></i></a></li>
                              <li class="breadcrumb-item">Dashboard</li>
                           </ol>
                        </div>
                     </div>
                  </div>
               </div>

            @php
            $count= 0;
            $count1= 0; 
            @endphp

             @foreach($business as $total)
              @php 
              $count = $count + count($total->branch_employee);
               $count1 = $count1 + $total->branch_reward->where('status',1)->count();
                @endphp 
               
               @endforeach 


               <!-- Container-fluid starts-->
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-sm-6 col-xl-4">
                        <div class="card o-hidden">
                        <a href="{{url('branch/my_companies')}}">
                           <div class="bg-primary b-r-4 card-body">
                              <div class="media static-top-widget">
                                 <div class="align-self-center text-center"><i class="fa fa-building fa-2x"></i></div>
                                 <div class="media-body">
                                    <span class="m-0">MY Companies</span>
                                    <h4 class="mb-0 counter">{{$total_companies}}</h4>
                                 </div>
                              </div>
                           </div>
</a>
                        </div>
                     </div>
                  
                     <div class="col-sm-6 col-xl-4">
                        <div class="card o-hidden">
                           <a href="{{url('branch/view_business')}}">
                           <div class="bg-primary b-r-4 card-body">
                              <div class="media static-top-widget">
                                 <div class="align-self-center text-center"><i data-feather="briefcase"></i></div>
                                 <div class="media-body">
                                    <span class="m-0">My Business</span>
                                    <h4 class="mb-0 counter">{{$business->count()}}</h4>
                                 </div>
                              </div>
                           </div>
                           </a>
                        </div>
                     </div>
                     <div class="col-sm-6 col-xl-4">
                        <div class="card o-hidden">
                        <a href="{{url('branch/view_employee')}}">
                           <div class="bg-primary b-r-4 card-body">
                              <div class="media static-top-widget">
                                 <div class="align-self-center text-center"><i data-feather="users"></i></div>
                                 <div class="media-body">
                                    <span class="m-0">My Employees</span>
                                    <h4 class="mb-0 counter">{{$count}}</h4>
                                    </i>
                                 </div>
                              </div>
                           </div>
</a>
                        </div>
                     </div>
               

                  </div>
                  <div class="row">
                    
                     

                     <div class="col-sm-6 col-xl-4">
                        <div class="card o-hidden">
                        <a href="{{url('branch/view_rewards')}}">
                           <div class="bg-secondary b-r-4 card-body">
                              <div class="media static-top-widget">
                                 <div class="align-self-center text-center"><i data-feather="gift"></i></div>
                                 <div class="media-body">
                                    <span class="m-0">Active Rewards</span>
                                    <h4 class="mb-0 counter">{{$count1}}</h4>
                                 </div>
                              </div>
                           </div>
</a>
                        </div>
                     </div>

                     <div class="col-sm-6 col-xl-4">
                        <div class="card o-hidden">
                        <a href="{{url('branch/reward_history')}}">
                           <div class="bg-secondary b-r-4 card-body">
                              <div class="media static-top-widget">
                                 <div class="align-self-center text-center"><i data-feather="gift"></i></div>
                                 <div class="media-body">
                                    <span class="m-0">Previous Rewards</span>
                                    <h4 class="mb-0 counter">{{$count1}}</h4>
                                 </div>
                              </div>
                           </div>
</a>
                        </div>
                     </div>
                           <div class="col-sm-6 col-xl-4">
                        <div class="card o-hidden" >
                        <a href="{{url('branch/view_licenses')}}">
                           <div class="bg-secondary b-r-4 card-body">
                              <div class="media static-top-widget">
                                 <div class="align-self-center text-center"><i data-feather="file-text"></i></div>
                                 <div class="media-body">
                                    <span class="m-0">  My Licenses</span>
                                    <h4 class="mb-0 counter">{{$total_license}}</h4>
                                    </i>
                                 </div>
                              </div>
                           </div>
</a>
                        </div>
                     </div>
                  </div>
                 


                  <div class="col-xl-12 xl-100 box-col-12">
                <div class="card">
                  <div class="cal-date-widget card-body">
                    <div class="row">
                      <div class="col-xl-6 col-md-12">
                        <div class="cal-info text-center">
                        <canvas id="canvas" width="400" height="400"
style="background-color:btn-primary">
</canvas>     
                     </div>
                      </div>
                      <div class="col-xl-6 col-md-12 " >
                        <div class="cal-datepicker">
                          <div class="datepicker-here mt-5 "  data-language="en">           </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


            
              
               </div>
            </div>
            <!-- footer start-->
            @include('branch.includes.footer')
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
      <script src="{{asset('public/assets/js/datepicker/date-picker/datepicker.js')}}"></script>
      <script src="{{asset('public/assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
      <script src="{{asset('public/assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
      <script src="{{asset('public/assets/js/counter/jquery.waypoints.min.js')}}"></script>
      <script src="{{asset('public/assets/js/counter/jquery.counterup.min.js')}}"></script>
      <script src="{{asset('public/assets/js/counter/jquery.waypoints.min.js')}}"></script>
      <script src="{{asset('public/assets/js/counter/jquery.counterup.min.js')}}"></script>
      <script src="{{asset('public/assets/js/counter/counter-custom.js')}}"></script>
      <script src="{{asset('public/assets/js/general-widget.js')}}"></script>

      <script src="{{asset('public/assets/js/owlcarousel/owl.carousel.js')}}"></script>
      <script>
         $('#hi').delay(2000).slideUp(1200);
      </script>
      <script type="text/javascript">
         $('#datatable_page').dataTable( {
           "pageLength": 25,
            "order": [[ 1, "desc" ]]
         } );
      </script>
      

      <script>
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var radius = canvas.height / 2;
ctx.translate(radius, radius);
radius = radius * 0.90
setInterval(drawClock, 1000);

function drawClock() {
  drawFace(ctx, radius);
  drawNumbers(ctx, radius);
  drawTime(ctx, radius);
}

function drawFace(ctx, radius) {
  var grad;
  ctx.beginPath();
  ctx.arc(0, 0, radius, 0, 2*Math.PI);
  ctx.fillStyle = 'white';
  ctx.fill();
  grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
  grad.addColorStop(0, '#040050');
  grad.addColorStop(0.5, 'white');
  grad.addColorStop(1, '#040050');
  ctx.strokeStyle = grad;
  ctx.lineWidth = radius*0.1;
  ctx.stroke();
  ctx.beginPath();
  ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
  ctx.fillStyle = '#FF9A19';
  ctx.fill();
}

function drawNumbers(ctx, radius) {
  var ang;
  var num;
  ctx.font = radius*0.15 + "px arial";
  ctx.textBaseline="middle";
  ctx.textAlign="center";
  for(num = 1; num < 13; num++){
    ang = num * Math.PI / 6;
    ctx.rotate(ang);
    ctx.translate(0, -radius*0.85);
    ctx.rotate(-ang);
    ctx.fillText(num.toString(), 0, 0);
    ctx.rotate(ang);
    ctx.translate(0, radius*0.85);
    ctx.rotate(-ang);
  }
}

function drawTime(ctx, radius){
    var now = new Date();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    //hour
    hour=hour%12;
    hour=(hour*Math.PI/6)+
    (minute*Math.PI/(6*60))+
    (second*Math.PI/(360*60));
    drawHand(ctx, hour, radius*0.5, radius*0.07);
    //minute
    minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
    drawHand(ctx, minute, radius*0.8, radius*0.07);
    // second
    second=(second*Math.PI/30);
    drawHand(ctx, second, radius*0.9, radius*0.02);
}

function drawHand(ctx, pos, length, width) {
    ctx.beginPath();
    ctx.lineWidth = width;
    ctx.lineCap = "round";
    ctx.moveTo(0,0);
    ctx.rotate(pos);
    ctx.lineTo(0, -length);
    ctx.stroke();
    ctx.rotate(-pos);
}
</script>
   </body>
</html>