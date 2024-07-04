@include('admin.includes.head');
<!-- Page Sidebar Start-->
<div class="sidebar-wrapper">
   <div>
      <div class="logo-wrapper py-2" >
         <a href="{{url('admin/dashboard')}}"><img class="img-fluid for-light pb-2" src="{{asset('public/assets/images/logo/logo.png')}}" alt="" style="height:65px; ">
        </a>
         <!-- <div class="back-btn"><i class="fa fa-angle-left"></i></div>
         <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div> -->
      </div>
      <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid" src="{{asset('public/assets/images/logo/logo-icon.png')}}" alt=""></a></div>
      <nav class="sidebar-main">
         <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
         <div id="sidebar-menu">
            <ul class="sidebar-links" id="simple-bar">
               
               <li class="back-btn">
                  <a href="index.html"><img class="img-fluid" src="{{asset('public/assets/images/logo/logo-icon.png')}}" alt=""></a>
                  <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
               </li>

               <li class="sidebar-list">
                  <a class="sidebar-link " href="{{ url('/admin/dashboard' )}}"><i data-feather="home"></i><span class="">Dashboard</span></a>
               </li>
               
              

               <li class="sidebar-list">
               
               <a class="sidebar-link " href="{{ url('/admin/profile' )}}"><i data-feather="user"></i><span class="">Profile</span></a>
               
               </li>
               <li class="sidebar-list">
                  <a class="sidebar-link " href="{{ url('/admin/companies' )}}"><i class="fas fa-city fa-md"></i><span class="" > All Companies</span></a>
               </li>
               <li class="sidebar-list">
                  <a class="sidebar-link " href="{{ url('/admin/my_companies' )}}"><i class="fa fa-building fa-md"></i><span class="" > My Companies</span></a>
               </li>
               <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title" href="#"><i data-feather="briefcase"></i><span>My Businesses</span></a>
                  <ul class="sidebar-submenu">
                     <li><a href="{{url('admin/add_business')}}">Add New</a></li>
                     <li><a href="{{url('admin/view_businesses')}}">View Business</a></li>
                  </ul>
               </li>

               <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title" href="#"> <i data-feather="users"></i><span> My Employees</span></a>
                  <ul class="sidebar-submenu">
                     <li><a href="{{url('admin/add_employees')}}">Add New</a></li>
                     <li><a href="{{url('admin/view_employees')}}">View Employees</a></li>
                  </ul>
               </li>

               <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title" href="#"> <i class="fas fa-chart-line"></i><span> Sales Record</span></a>
                  <ul class="sidebar-submenu">
                     <li><a href="{{url('admin/add_sale')}}">Add New</a></li>
                     <li><a href="{{url('admin/view_sale')}}">View Record</a></li>
                  </ul>
               </li>

               <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title" href="#"> <i data-feather="gift"></i><span>Rewards</span></a>
                  <ul class="sidebar-submenu">
                     <li><a href="{{url('admin/add_rewards')}}">Add New</a></li>
                     <li><a href="{{url('admin/view_rewards')}}">current Rewards</a></li>
                     <li><a href="{{url('admin/reward_history')}}">History</a></li>
                  </ul>
               </li>

               <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title" href="#"> <i data-feather="clipboard"></i><span>My Licenses  
                  @if(session('key') > 0 )
                  <span class="badge rounded-pill badge-danger" style="color:white">
                 {{session('key')}}  </span>   @endif
                 </span></a> 
                  <ul class="sidebar-submenu">
                     <li><a href="{{url('admin/add_license')}}">Add New</a></li>
                     <li><a href="{{url('admin/view_license')}}">View Licenses</a></li>
                  </ul>
               </li>

               <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title" href="#"><i data-feather="package"></i><span>Subscription Packages</span></a>
                  <ul class="sidebar-submenu">
                     <li><a href="{{url('admin/add_pkg')}}">Add New</a></li>
                     <li><a href="{{url('admin/view_pkg')}}">View Packages</a></li>
                  </ul>
               </li>

               <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title" href="#"><i data-feather="users"></i><span>Subscribers</span></a>
                  <ul class="sidebar-submenu">
                     <li><a href="{{url('admin/active_subscribers')}}">Active</a></li>
                     <li><a href="{{url('admin/blocked_subscribers')}}">Blocked</a></li>
                  </ul>
               </li>

               <li class="sidebar-list">
                  <a class="sidebar-link " href="{{url('admin/lnc_org')}}"><i class="fa fa-building fa-md"></i><span class="" >  License Organization </span></a>
               </li>

               <li class="sidebar-list">
                  <a class="sidebar-link " href="{{ url('/admin/licenses' )}}"><i data-feather="file-minus"></i><span class="">Licenses</span></a>
               </li>

              
               <li class="sidebar-list">
                  <a class="sidebar-link " href="{{ url('/admin/transactions' )}}"><i data-feather="dollar-sign"></i><span class="">Transactions</span></a>
               </li>
               <li class="sidebar-list" style="color: red;">
                  <a  class="sidebar-link " href="{{ url('/admin/logout' )}}"><i data-feather="power" style="color: red !important;" ></i><span style="color: red !important;">Logout</span></a>
               </li>
            </ul>
         </div>
         <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </nav>
   </div>
</div>
<!-- Page Sidebar Ends-->