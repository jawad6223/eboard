@include('branch.includes.head');
<!-- Page Sidebar Start-->
<div class="sidebar-wrapper">
   <div>
      <div class="logo-wrapper py-2" >
         <a href="{{url('branch/dashboard')}}"><img class="img-fluid for-light pb-2" src="{{asset('public/assets/images/logo/logo.png')}}" alt="" style="height:65px; ">
        </a>

      </div>
      <div class="logo-icon-wrapper"><a href="{{ url('/branch/dashboard' )}}"><img class="img-fluid" src="{{asset('public/assets/images/logo/logo-icon.png')}}" alt=""></a></div>
      <nav class="sidebar-main">
         <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
         <div id="sidebar-menu">
            <ul class="sidebar-links" id="simple-bar">

               <li class="back-btn">
                  <a href="{{ url('/branch/dashboard' )}}"><img class="img-fluid" src="{{asset('public/assets/images/logo/logo-icon.png')}}" alt=""></a>
                  <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
               </li>

               <li class="sidebar-list">
                  <a class="sidebar-link " href="{{ url('/branch/dashboard' )}}"><i data-feather="home"></i><span class ="">Dashboard</span></a>
               </li>

               <li class="sidebar-list">
                  <a class="sidebar-link " href="{{ url('/branch/profile' )}}"><i data-feather="user"></i><span class="">Profile</span></a>
               </li>

               <li class="sidebar-list">
                  <a class="sidebar-link " href="{{ url('/branch/my_companies' )}}"><i class="fa fa-building fa-md"></i><span class="" > My Companies</span></a>
               </li>
              

               <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title" href="#"><i data-feather="briefcase"></i><span>My Businesses 
                   @if(session('key1') > 0 )
                  <span class="badge rounded-pill badge-danger" style="color:white">
                 {{session('key1')}}  </span>   @endif
                  </span></a>
                    
                  <ul class="sidebar-submenu">
                     <li><a href="{{url('branch/add_business')}}">Add New</a></li>
                     <li><a href="{{url('branch/view_business')}}">View Business</a></li>
                  </ul>
               </li>

               <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title" href="#"> <i data-feather="users"></i><span style="padding-left:10px">Employees</span></a>
                  <ul class="sidebar-submenu">
                     <li><a href="{{url('branch/add_employee')}}">Add New</a></li>
                     <li><a href="{{url('branch/view_employee')}}">View Employees</a></li>
                  </ul>
               </li>

               <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title" href="#"> <i class="fas fa-chart-line"></i><span> Sales Record</span></a>
                  <ul class="sidebar-submenu">
                     <li><a href="{{url('branch/add_sale')}}">Add New</a></li>
                     <li><a href="{{url('branch/view_sale')}}">View Record</a></li>
                  </ul>
               </li>

               <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title" href="#"> <i data-feather="gift"></i><span style="padding-left:10px">Rewards</span></a>
                  <ul class="sidebar-submenu">
                     <li><a href="{{url('branch/add_rewards')}}">Add New</a></li>
                     <li><a href="{{url('branch/view_rewards')}}">current Rewards</a></li>
                    <li><a href="{{url('branch/reward_history')}}">History</a></li>
                  </ul>
               </li>

               <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title" href="#"> <i data-feather="clipboard"></i><span style="padding-left:10px">My Licenses
                    @if(session('key') > 0 )
                  <span class="badge rounded-pill badge-danger" style="color:white">
                 {{session('key')}}  </span>   @endif
                  </span></a>
                  <ul class="sidebar-submenu">
                     <li><a href="{{url('branch/add_licenses')}}">Add New</a></li>
                     <li><a href="{{url('branch/view_licenses')}}">View Licenses
                     
                     </a></li>
                  </ul>
               </li>

               <!-- <li class="sidebar-list">
                  <a class="sidebar-link " href="{{ url('/branch/trasactions' )}}"><i data-feather="dollar-sign"></i><span class="">Transactions</span></a>
               </li> -->
               
               <li class="sidebar-list" style="color: red;">
                  <a  class="sidebar-link " href="{{ url('/branch/logout' )}}"><i data-feather="power" style="color: red !important;" ></i><span style="color: red !important;">Logout</span></a>
               </li>
               
            </ul>
         </div>
         <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </nav>
   </div>
</div>
<!-- Page Sidebar Ends-->