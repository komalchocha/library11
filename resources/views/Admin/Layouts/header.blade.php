 <div class="topbar">

     <div class="topbar-left	d-none d-lg-block">
         <div class="text-center">

             <a href="index.html" class="logo"><img src="{{ asset('assets/images/logo.png') }}" height="60" width="150" alt="logo"></a>
         </div>
     </div>

     <nav class="navbar-custom">

         <ul class="list-inline float-right mb-0">
             <li class="list-inline-item notification-list dropdown d-none d-sm-inline-block">
                 <form role="search" class="app-search">
                     <div class="form-group mb-0">
                         <input type="text" class="form-control" placeholder="Search..">
                         <button type="submit"><i class="fa fa-search"></i></button>
                     </div>
                 </form>
             </li>

             <li class="list-inline-item nav-item dropdown">
                 <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                     {{ Auth::guard('admin')->user()->email }}
                 </a>

                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                     <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}
                     </a>

                     <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                         @csrf
                     </form>
                 </div>
             </li>
             <li class="list-inline-item dropdown notification-list">
                 <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                     <img src="assets/images/users/user-1.jpg" alt="user" class="rounded-circle">
                 </a>
                 <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                     <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                     <a class="dropdown-item" href="#"><span class="badge badge-success mt-1 float-right">5</span><i class="mdi mdi-settings m-r-5 text-muted"></i> Settings</a>
                     <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> Lock screen</a>
                     <a class="dropdown-item" href="#"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                 </div>
             </li>

         </ul>

         <ul class="list-inline menu-left mb-0">
             <li class="list-inline-item">
                 <button type="button" class="button-menu-mobile open-left waves-effect">
                     <i class="ion-navicon"></i>
                 </button>
             </li>
         </ul>

         <div class="clearfix"></div>

     </nav>

 </div>