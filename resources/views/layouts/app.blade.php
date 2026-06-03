<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>Dashboard</title>
      <meta content="" name="description">
      <meta content="" name="keywords">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- Favicons -->
      <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
      <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
      <!-- Google Fonts -->
      <link href="https://fonts.gstatic.com" rel="preconnect">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
      <!-- Template Main CSS File -->
      <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
      <!-- Add this to your <head> section if SweetAlert is not included -->


      <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/bundles/summernote/summernote-bs4.css') }}">
      @yield('style')

   </head>
   <body>
      <div id="app">
         <div class="main-wrapper main-wrapper-1">
            <nav class="navbar navbar-expand-lg main-navbar sticky">
               <div class="form-inline mr-auto">
                  <ul class="navbar-nav mr-3">
                     <li>
                        <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn">
                        <i data-feather="align-justify"></i>
                        </a>
                     </li>
                     <li>
                        <a href="#" class="nav-link nav-link-lg fullscreen-btn">
                        <i data-feather="maximize"></i>
                        </a>
                     </li>
                     <li>
                        <form class="form-inline mr-auto">
                           <div class="search-element">
                              <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
                              <button class="btn" type="submit">
                              <i class="fas fa-search"></i>
                              </button>
                           </div>
                        </form>
                     </li>
                  </ul>
               </div>
               <ul class="navbar-nav navbar-right">
                  <!-- Messages -->
                  <li class="dropdown dropdown-list-toggle">
                     <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle">
                     <i data-feather="mail"></i>
                     <span class="badge headerBadge1">6</span>
                     </a>
                     <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                        <div class="dropdown-header">
                           Messages
                           <div class="float-right">
                              <a href="#">Mark All As Read</a>
                           </div>
                        </div>
                        <div class="dropdown-list-content dropdown-list-message">
                           <a href="#" class="dropdown-item">
                           <span class="dropdown-item-avatar text-white">
                           <img alt="image" src="assets/img/users/user-1.png" class="rounded-circle">
                           </span>
                           <span class="dropdown-item-desc">
                           <span class="message-user">John Deo</span>
                           <span class="time messege-text">Please check your mail !!</span>
                           <span class="time">2 Min Ago</span>
                           </span>
                           </a>                           
                        </div>
                        <div class="dropdown-footer text-center">
                           <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                        </div>
                     </div>
                  </li>
                  <!-- Notifications -->
                  <li class="dropdown dropdown-list-toggle">
                     <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg">
                     <i data-feather="bell" class="bell"></i>
                     </a>
                     <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                        <div class="dropdown-header">
                           Notifications
                           <div class="float-right">
                              <a href="#">Mark All As Read</a>
                           </div>
                        </div>
                        <div class="dropdown-list-content dropdown-list-icons">
                           <a href="#" class="dropdown-item dropdown-item-unread">
                           <span class="dropdown-item-icon bg-primary text-white">
                           <i class="fas fa-code"></i>
                           </span>
                           <span class="dropdown-item-desc">
                           Template update is available now!
                           <span class="time">2 Min Ago</span>
                           </span>
                           </a>
                        </div>
                        <div class="dropdown-footer text-center">
                           <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                        </div>
                     </div>
                  </li>
                  <!-- User -->
                <li class="dropdown">

                     @php
                        $user = session('user');
                     @endphp

                     <a href="#"
                        data-toggle="dropdown"
                        class="nav-link dropdown-toggle nav-link-lg nav-link-user">

                     @if($user && !empty($user['profile_photo']))
                     <img src="{{ env('API_BASE_URL') }}/storage/{{ $user['profile_photo'] }}" alt="{{ $user['name'] }}" class="rounded-circle mb-3">
                        

                     @else
                        <img src="{{ asset('assets/img/user.png') }}"
                              class="user-img-radious-style"
                              alt="Default User">

                     @endif
                        <span class="d-sm-none d-lg-inline-block">

                           {{ $user['name'] ?? 'Guest' }}

                        </span>

                     </a>

                     <div class="dropdown-menu dropdown-menu-right pullDown">

                        <div class="dropdown-title">

                           @if($user)

                                 Role :
                                 {{ $user['role'] ?? 'No Role' }}

                           @else

                                 Guest

                           @endif
                           <a href="profile.html" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
                           </a> 
                           <a href="timeline.html" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                              Activities
                           </a> <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                              Settings
                           </a>
                           <div class="dropdown-divider"></div>
                           
                           <form action="{{ route('logout') }}" method="POST">
                              @csrf
                              <button type="submit" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                                 Logout
                              </button>
                           </form>

                        </div>

                       

                     </div>

               </li>

               </ul>
            </nav>
            <!-- NAVBAR END -->
            <!-- SIDEBAR START -->
            <div class="main-sidebar sidebar-style-2">
               <aside id="sidebar-wrapper">
                  <div class="sidebar-brand">
                     <a href="index.html">
                     <img alt="image" src="{{ asset('assets/img/logo.png') }}" class="header-logo" />
                     <span class="logo-name">EHT</span>
                     </a>
                  </div>
                  <ul class="sidebar-menu">

                     {{-- Dashboard --}}
                     <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                              <i data-feather="monitor"></i><span>Dashboard</span>
                        </a>
                     </li>
                     <li class="dropdown {{ request()->routeIs('users.*') ? 'active' : '' }}">

                           <a href="#" class="nav-link has-dropdown">
                              <i class="fas fa-users"></i>
                              <span>User Management</span>
                           </a>

                           <ul class="dropdown-menu">

                              <li class="{{ request()->routeIs('users.index') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('users.index') }}">
                                       User List
                                    </a>
                              </li>

                              <li class="{{ request()->routeIs('users.create') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('users.create') }}">
                                       Create User
                                    </a>
                              </li>

                           </ul>

                        </li>

                        <li class="dropdown {{ request()->routeIs('roles.*') ? 'active' : '' }}">

                           <a href="#" class="nav-link has-dropdown">
                              <i class="fas fa-user-shield"></i>
                              <span>Role Management</span>
                           </a>

                           <ul class="dropdown-menu">

                              <li class="{{ request()->routeIs('roles.index') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('roles.index') }}">
                                       Role List
                                    </a>
                              </li>

                             

                           </ul>

                        </li>

                        <li class="dropdown {{ request()->routeIs('permissions.*') ? 'active' : '' }}">

                           <a href="#" class="nav-link has-dropdown">
                              <i class="fas fa-key"></i>
                              <span>Permission Management</span>
                           </a>

                           <ul class="dropdown-menu">

                              <li class="{{ request()->routeIs('permissions.index') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('permissions.index') }}">
                                       Permission List
                                    </a>
                              </li>

                              <li class="{{ request()->routeIs('permissions.create') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('permissions.create') }}">
                                       Create Permission
                                    </a>
                              </li>

                           </ul>

                        </li>
                        <li>
                           <a href="{{ route('branches.index') }}">
                              Branches
                           </a>
                        </li>
                        <li>
                           <a href="{{ route('branches.my') }}">
                              My Branches
                           </a>
                        </li>
                  </ul>

                
               </aside>
            </div>
            <main id="main-contentmain" class="main-content">
               @yield('content')
            </main>
         </div>
      </div>
      <script src="{{ asset('assets/js/app.min.js') }}"></script>
      <script src="{{ asset('assets/bundles/datatables/datatables.min.js') }}"></script>
      <script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
      <script src="{{ asset('assets/bundles/datatables/export-tables/dataTables.buttons.min.js') }}"></script>
      <script src="{{ asset('assets/bundles/datatables/export-tables/buttons.flash.min.js') }}"></script>
      <script src="{{ asset('assets/bundles/datatables/export-tables/jszip.min.js') }}"></script>
      <script src="{{ asset('assets/bundles/datatables/export-tables/pdfmake.min.js') }}"></script>
      <script src="{{ asset('assets/bundles/datatables/export-tables/vfs_fonts.js') }}"></script>
      <script src="{{ asset('assets/bundles/datatables/export-tables/buttons.print.min.js') }}"></script>
      <script src="{{ asset('assets/js/page/datatables.js') }}"></script>
      <script src="{{ asset('assets/js/scripts.js') }}"></script>
      <script src="{{ asset('assets/js/custom.js') }}"></script>
      <script src="{{ asset('assets/bundles/summernote/summernote-bs4.js') }}"></script>
    
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      @stack('scripts')
   </body>
</html>