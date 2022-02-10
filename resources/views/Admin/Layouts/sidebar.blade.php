 <div class="left side-menu">
     <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
         <i class="ion-close"></i>
     </button>

     <div class="left-side-logo d-block d-lg-none">
         <div class="text-center">
             <a href="index.html" class="logo logo-admin"><img src="{{ asset('assets/images/logo.png') }}" height="60" width="150" alt="logo"></a>
         </div>
     </div>

     <div class="sidebar-inner slimscrollleft">

         <div id="sidebar-menu">
             <ul>

                 <li>
                     <a href="{{route('admin.dashboard')}}" class="waves-effect">
                         <i class="dripicons-meter"></i>
                         <span> Dashboard <span class="badge badge-success badge-pill float-right"></span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></span>
                     </a>
                 </li>

                 <li>
                     <a href="{{route('admin.book.category_view_list')}}" class="waves-effect">
                         <i class="dripicons-briefcase"></i>
                         <span>Book Category<span class="badge badge-success badge-pill float-right"></span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></span>
                     </a>
                 </li>
                 <li>
                     <a href="{{route('admin.book.book_view_list')}}" class="waves-effect">
                         <i class="dripicons-briefcase"></i>
                         <span>Books<span class="badge badge-success badge-pill float-right"></span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></span>
                     </a>
                 </li>
                 <li>
                     <a href="{{route('admin.bookissue.book_issue_view')}}" class="waves-effect">
                         <i class="dripicons-briefcase"></i>
                         <span>Book Issue<span class="badge badge-success badge-pill float-right"></span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></span>
                     </a>
                 </li>


             </ul>
         </div>
         <div class="clearfix"></div>
     </div> <!-- end sidebarinner -->
 </div>