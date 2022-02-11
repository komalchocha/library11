 <div class="topbar">

     <div class="topbar-left	d-none d-lg-block">
         <div class="text-center">

             <a href="index.html" class="logo"><img src="{{ asset('assets/images/logo.png') }}" height="60" width="150" alt="logo"></a>
         </div>
     </div>

     <nav class="navbar-custom">

         <ul class="list-inline float-right mb-0">

             <li class="list-inline-item nav-item dropdown">
                 <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                     {{ Auth::guard('admin')->user()->email }}
                 </a>

                 <div class="dropdown-menu dropdown-menu-right logout" aria-labelledby="navbarDropdown">
                     <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}
                     </a>

                     <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                         @csrf
                     </form>
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