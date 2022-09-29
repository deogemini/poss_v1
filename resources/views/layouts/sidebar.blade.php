<nav id="sidebar">
        <div class="sidebar-header">
            <h3>POSS Dashboard</h3>
        </div>

        <ul class="list-unstyled components">
          
        <li>
                <a href="{{ url ('/dashboard') }}"> 
                <i class="fa fa-home" aria-hidden="true"></i>
                <span>Home</span>
                </a>
            </li>

            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fa fa-users" aria-hidden="true"></i>
                <span>Users</span></a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="/districtOfficer">District Officers</a>
                    </li>
                    <li>
                        <a href="/wardOfficer">Ward Officers</a>
                    </li>
                    <li>
                        <a href="headTeacher">Head Masters</a>
                    </li>
                    <li>
                        <a href="teacher">Teachers</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fa fa-compass" aria-hidden="true"></i><span>
                    Locations
                </span>
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenu1">
                    <li>
                        <a href="/region">Regions</a>
                    </li>
                    <li>
                        <a href="/districts">Districts</a>
                    </li>
                    <li>
                        <a href="/wards">Wards</a>
                    </li>
            
                </ul>
            </li>

            <li>
                <a href="#pageSubmenu4" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fa fa-school" aria-hidden="true"></i><span>
                    School Management
                </span>
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenu4">
                    <li>
                        <a href="/schools">School</a>
</li>
                    <li>
                        <a href="/streams">Stream</a>
                    </li>
            
                </ul>
            </li>
            @if($role == 'isHeadTeacher')
            <li>
                <a href="/studentsinschool">
                    <i class="fa fa-child" aria-hidden="true"></i>
                    <span>Students at Your School</span>
                </a>
            </li>
            @endif
            <li>
                <a href="/students">
                    <i class="fa fa-child" aria-hidden="true"></i>
                    <span>Students</span>
                </a>
            </li>
            <li>
                <a href="/attendanceReports">
                <i class="fa fa-file"></i>
                    <span>Attendance Reports
                    </span>
                    </a>
            </li>
            <li>
            <a href="{{ url('/privacy_policy')}}">
            <i class="fa fa-user-secret" aria-hidden="true"></i>
            <span>Privacy Policy</span>
                </a>
            </li>

            <li>
                <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fa fa-wrench" aria-hidden="true"></i>
<span>System Settings</span></a>
                <ul class="collapse list-unstyled" id="pageSubmenu3">
                    <li>
                        <a href="/roles">User Roles</a>
                    </li>
                    <li>
                        <a href="/auditReports">Audit Reports</a>
                    </li>
                    <li>
                        <a href="/userProfile">User Profile</a>
                    </li>
                    <li>
                        <a href="/finishingYears">Finishing Year</a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="{{ url('/logout') }}">
                <i class="fa fa-power-off" aria-hidden="true"></i>
            <span>Logout</span>
                    </a>
            </li>
        </ul>

    </nav>