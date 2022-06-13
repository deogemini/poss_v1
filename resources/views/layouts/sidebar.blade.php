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
            <a href="{{ url('/admin') }}" class="nav-link">
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