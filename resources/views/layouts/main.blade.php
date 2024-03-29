<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'POSS_APP') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet"/>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <!-- Styles -->
    <link href="../css/style.css" rel="stylesheet">

    <style>
        /*
    DEMO STYLE
*/

@import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";
body {
    font-family: 'Poppins', sans-serif;
    background: #fafafa;
}

p {
    font-family: 'Poppins', sans-serif;
    font-size: 1.1em;
    font-weight: 300;
    line-height: 1.7em;
    color: #999;
}

a,
a:hover,
a:focus {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s;
}

.navbar {
    padding: 15px 10px;
    background: #fff;
    border: none;
    border-radius: 0;
    margin-bottom: 40px;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
}
        .custom-card {
            width: 350px;
            height: 110px;
        }

        .datepicker table {
            width: 100%;
            font-size: 14px;
        }

        .datepicker th,
        .datepicker td {
            padding: 10px;
            text-align: center;
        }

        .datepicker thead th {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .datepicker tbody td {
            color: #333;
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .datepicker tbody td.today,
        .datepicker tbody td.today:hover,
        .datepicker tbody td.today.disabled,
        .datepicker tbody td.today.disabled:hover {
            font-weight: bold;
            background-color: #f0ad4e;
            color: #fff;
        }



        .navbar-btn {
    box-shadow: none;
    outline: none !important;
    border: none;
}

.line {
    width: 100%;
    height: 1px;
    border-bottom: 1px dashed #ddd;
    margin: 40px 0;
}

/* ---------------------------------------------------
    SIDEBAR STYLE
----------------------------------------------------- */

.wrapper {
    display: flex;
    width: 100%;
    align-items: stretch;
}

#sidebar {
    min-width: 250px;
    max-width: 250px;
    background: #7386D5;
    color: #fff;
    transition: all 0.3s;
}

#sidebar.active {
    margin-left: -250px;
}

#sidebar .sidebar-header {
    padding: 20px;
    background: #6d7fcc;
}

#sidebar ul.components {
    padding: 20px 0;
    border-bottom: 1px solid #47748b;
}

#sidebar ul p {
    color: #fff;
    padding: 10px;
}

#sidebar ul li a {
    padding: 10px;
    font-size: 1.1em;
    display: block;
}

#sidebar ul li a:hover {
    color: #7386D5;
    background: #fff;
}

#sidebar ul li.active>a,
a[aria-expanded="true"] {
    color: #fff;
    background: #6d7fcc;
}

a[data-toggle="collapse"] {
    position: relative;
}

.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
}

ul ul a {
    font-size: 0.9em !important;
    padding-left: 30px !important;
    background: #6d7fcc;
}

ul.CTAs {
    padding: 20px;
}

ul.CTAs a {
    text-align: center;
    font-size: 0.9em !important;
    display: block;
    border-radius: 5px;
    margin-bottom: 5px;
}

a.download {
    background: #fff;
    color: #7386D5;
}

a.article,
a.article:hover {
    background: #6d7fcc !important;
    color: #fff !important;
}

        .fa-download:hover {
            cursor: pointer;
            color: red;
            text-decoration: underline;
        }
        .fa-window-maximize:hover {
            cursor: pointer;
            color: red;
            text-decoration: underline;
        }

/* ---------------------------------------------------
    CONTENT STYLE
----------------------------------------------------- */

#content {
    width: 100%;
    padding: 20px;
    min-height: 100vh;
    transition: all 0.3s;
}

/* ---------------------------------------------------
    MEDIAQUERIES
----------------------------------------------------- */

@media (max-width: 768px) {
    #sidebar {
        margin-left: -250px;
    }
    #sidebar.active {
        margin-left: 0;
    }
    #sidebarCollapse span {
        display: none;
    }
}
    </style>
</head>
<body>
<?php
if(Auth::check()){
$user = Auth::user();
$user_id = $user->id;
$role_user = App\Models\RoleUser::where('user_id', $user_id)->first();
$role_name = App\Models\Role::where('id', $role_user->role_id)->first();
$role = $role_name->name;
}

?>
<div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>POSS Dashboard</h3>
        </div>

        <ul class="list-unstyled components">
        @if($role == 'isAdmin')
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
                        <i class="fas fa-school" aria-hidden="true"></i><span>

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

            @endif

            @if($role == 'isHeadTeacher')
            <li>
                <a href="#">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="/studentsinschool">
                    <i class="fa fa-child" aria-hidden="true"></i>
                    <span>Students</span>
                </a>
            </li>
            <li>
                <a href="/teachersinschool">
                    <i class="fa fa-chalkboard-teacher" aria-hidden="true"></i>
                    <span>Teachers</span>
                </a>
            </li>
            <li>
                <a href="/teachersondutyinschool">
                    <i class="fa fa-chalkboard-teacher" aria-hidden="true"></i>
                    <span>Teachers On Duty</span>
                </a>
            </li>
            <li>

                        <a href="/userProfile">
                        <i class="fa fa-user" aria-hidden="true"></i>
                           <span>User Profile</span> </a>
                    </li>
            @endif
            @if($role == 'isTeacher')
             <li>
                <a href="/studentsinyourschool">
                    <i class="fa fa-child" aria-hidden="true"></i>
                    <span>Students for your School</span>
                </a>
            </li>
            @endif

            @if($role == 'isAdmin')
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
            @endif

            @if($role == 'isAdmin')

            <li>
                <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fa fa-wrench" aria-hidden="true"></i>
<span>System Settings</span></a>
                <ul class="collapse list-unstyled" id="pageSubmenu3">
                    <li>
                        <a href="/roles">User Roles</a>
                    </li>
                    <!-- <li>
                        <a href="/auditReports">Audit Reports</a>
                    </li> -->


                    <li>
                        <a href="/userProfile">User Profile</a>
                    </li>
                    <li>
                        <a href="/finishingYears">Finishing Year</a>
                    </li>
                    <li>
                        <a href="/finishingYears">Reset Users Password</a>
                    </li>


                </ul>
            </li>

            <li>
            <a href="{{ url('/privacy_policy')}}">
            <i class="fa fa-user-secret" aria-hidden="true"></i>
            <span>Privacy Policy</span>
                </a>
            </li>
            @endif

            <li>
                <a href="{{ url('/logout') }}">
                <i class="fa fa-power-off" aria-hidden="true"></i>
            <span>Logout</span>
                    </a>
            </li>
        </ul>

    </nav>
    <!-- Page Content -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                </button>
            </div>
            <a class="navbar-brand">PROTECTING OUR STUDENTS IN SCHOOL (POSS)</a>
        </nav>
        <section class="content">
                @if (\Session::has('msg'))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success alert-dismissible">{{ \Session('msg') }}</div>
                        </div>
                    </div>
                @endif
        </section>

        <main class="py-4">
            @yield('content')
        </main>
    </div>


</div>







<!-- Footer -->
<footer class="page-footer font-small cyan">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2022 Copyright:
    <a href="/"> www.POSS.com</a>
  </div>
  <!-- Copyright -->


</footer>
<!-- Footer -->



<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $("#sidebarCollapse").on('click', function(){
          $("#sidebar").toggleClass('active');
        });
      });
    </script>
</body>
</html>
