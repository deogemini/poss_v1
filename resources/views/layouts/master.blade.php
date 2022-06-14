<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>POSS DASHBOARD</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->

  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

       <!-- Right navbar links -->
       <ul class="navbar-nav ml-auto">
       <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
        <i class="nav-icon fas fa-user-gear"></i>SYSTEM ADMIN</a>
      </li>
       </ul>
  </nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-light">Admin Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="pushmenu" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="/admin" class="nav-link">
              <i class="nav-icon fas fa-igloo"></i>
              <p>
              HOME
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ url('/regions') }}" class="nav-link">
                  <i class="nav-icon fas fa-city"></i>
                  <p>REGIONS</p>
                </a>
              <li class="nav-item">
                <a href="{{ url('/districts') }}" class="nav-link">
                  <i class="nav-icon fas fa-building"></i>
                  <p>DISTRICTS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/wards') }}" class="nav-link">
                  <i class="nav-icon fas fa-building-wheat"></i>
                  <p>WARDS</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{ url('/districtsOfficers') }}" class="nav-link">
                  <i class="nav-icon fas fa-person"></i>
                  <p>DISTRICT OFFICERS</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{ url('/wardOfficers') }}" class="nav-link">
                  <i class="nav-icon fas fa-person"></i>
                  <p>WARD OFFICERS</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{ url('/schools') }}" class="nav-link">
                  <i class="nav-icon fas fa-school"></i>
                  <p>SCHOOLS</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{ url('/headTeachers') }}" class="nav-link">
                  <i class="nav-icon fas fa-chalkboard-user"></i>
                  <p>HEAD TEACHERS</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{ url('/teachers') }}" class="nav-link">
                  <i class="nav-icon fas fa-person-chalkboard"></i>
                  <p>TEACHERS</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{ url('/students') }}" class="nav-link">
                  <i class="nav-icon fas fa-graduation-cap"></i>
                  <p>STUDENTS</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ url('/logout') }}" class="nav-link">
              <i class="nav-icon fas fa-sign-out"></i>
              <p>
                LOGOUT
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <main class="py-4">
            @yield('content')
        </main>





     <!-- Main Footer -->
     <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Students must be protected
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2022</strong> All rights reserved.
  </footer>
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('js/app.js') }}" ></script>
<script src="{{ asset('js/admin-lte.js') }}" ></script>
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>

<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>

<script src="{{asset('assets/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
 <!-- Bootstrap 4 - -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App - -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
</body>
</html>
