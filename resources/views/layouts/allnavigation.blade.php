
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    @if(session('notifications'))
        @php
            $notifications = session('notifications');
        @endphp
    @endif
                    

    <!-- Sidebar - Brand -->
    {{-- @if(Auth::user()->hasRole('admin')) --}}
    {{-- @can('admin') --}}
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    {{-- @endcan --}}
    {{-- @endif --}}

    {{-- @if(Auth::user()->hasRole('manager')) --}}
    @can('manager')
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/manager">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Manager</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/manager">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    @endcan
    {{-- @endif --}}

    {{-- @if(Auth::user()->hasRole('employee')) --}}
    @can('employee')
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Employee </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/employee">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    @endcan
    {{-- @endif --}}

    <!-- Nav Item - Pages Collapse Menu -->
    {{-- @if(Auth::user()->hasRole('admin')) --}}

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        CRUD Menu
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-users"></i>
            <span>Users</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a id="addUserLink" class="collapse-item" href="/users/newuser">Add New User</a>
                <a id="manageUsersLink" class="collapse-item" href="/users/admincrud">Manage Users</a>
            </div>
        </div>
    </li>
    {{-- @endif --}}

    @if(Auth::user()->hasRole('manager'))
    <hr class="sidebar-divider">

    <!-- Heading -->
   
    <div class="sidebar-heading">
        Accounts
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-users"></i>
            <span>Employee</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a id="addEmployeeLink" class="collapse-item" href="/employees/newemp">Add Employees</a>
                <a id="manageEmployeeLink" class="collapse-item" href="/employees/managercrud">Manage Employees</a>
            </div>
        </div>
    </li>
    @endif

    <!-- Nav Item - Utilities Collapse Menu -->
    <!-- Divider -->
    @if(Auth::user()->hasRole('employee'))
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Personal Infromation
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
   
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Contact Details</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a id="viewContactDetailsLink" class="collapse-item" href="/employeecrud">View</a>
            </div>
        </div>
    </li>
    @endif

    @if(Auth::user()->hasRole('manager'))
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Applications
    </div>

    
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
            aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-tasks"></i>
            <span>Tasks</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a id="addTasksLink" class="collapse-item" href="/createtasks">Add Tasks</a>
                <a id="tasksDetailsLink" class="collapse-item" href="/tasks">Tasks Details</a>
            </div>
        </div>
    </li>
    @endif

    @if(Auth::user()->hasRole('manager'))
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
            aria-expanded="true" aria-controls="collapseFive">
            <i class="fas fa-table"></i>
            <span>Attendance</span>
        </a>
        <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a id="addAttendanceLink" class="collapse-item" href="/addattandance">Add Attendance</a>
                <a id="viewAttendanceLink" class="collapse-item" href="/showallattandance">View Attendance</a>
            </div>
        </div>
    </li>
    @endif

    {{-- @if(Auth::user()->hasRole('manager') || Auth::user()->hasRole('admin')) --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix"
            aria-expanded="true" aria-controls="collapseSix">
            <i class="fas fa-share"></i>
            <span>Leave Manage</span>
        </a>
        <div id="collapseSix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a id="viewLeaveApplicationsLink" class="collapse-item" href="/showallleaveReq">View Leave Applications</a>
            </div>
        </div>
    </li>
    {{-- @endif --}}

    @if(Auth::user()->hasRole('manager'))
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTen"
            aria-expanded="true" aria-controls="collapseTen">
            <i class="fas fa-money-bill-wave"></i>
            <span>Salary Details</span>
        </a>
        <div id="collapseTen" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a id="viewMySalaryLink" class="collapse-item" href="/showmanagersalary">View My Salary</a>
            </div>
        </div>
    </li>
    @endif

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Info
    </div>

    <!-- Nav Item - Pages Collapse Menu -->

    <!-- Nav Item - Charts -->
    @if(Auth::user()->hasRole('employee'))
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseXYZ"
            aria-expanded="true" aria-controls="collapseXYZ">
            <i class="fas fa-rupee-sign text-gray-500"></i>
            <span>Salary</span>
        </a>
        <div id="collapseXYZ" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a id="viewEmpSalaryDetailsLink" class="collapse-item" href="/showempsalary">View My Salary</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseABC"
            aria-expanded="true" aria-controls="collapseABC">
            <i class="fas fa-book-open text-gray-500"></i>
            <span>Attendance</span>
        </a>
        <div id="collapseABC" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a id="viewEmpAttendanceDetailsLink" class="collapse-item" href="/showempattandance">View My Attendance</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePQR"
            aria-expanded="true" aria-controls="collapsePQR">
            <i class="fas fa-project-diagram text-gray-500"></i>
            <span>Tasks</span>
        </a>
        <div id="collapsePQR" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a id="viewEmpTaskDetailsLink" class="collapse-item" href="/showemptask">View My Tasks</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
            aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-share text-gray-500"></i>
            <span>Leaves</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a id="applyLeaveLink" class="collapse-item" href="/showEmpLeave">Apply Leave</a>
                <a id="leaveHistoryLink" class="collapse-item" href="/showleavedetails">leave History</a>
            </div>
        </div>
    </li>
    @endif
    <!-- Nav Item - Pages Collapse Menu -->

    <!-- Nav Item - Charts -->
    {{-- @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager') ) --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            {{-- <i class="fas fa-users"></i> --}}
            <i class="fas fa-people-arrows"></i>
            <span>Roles</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a id="addRolesLink" class="collapse-item" href="/roles/usertype">Add Roles</a>
                <a id="manageRolesLink"  class="collapse-item" href="/roles/adminrole">Manage Roles</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven"
            aria-expanded="true" aria-controls="collapseSeven">
            <i class="fas fa-shield-alt"></i>
            <span>Permissions</span>
        </a>
        <div id="collapseSeven" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a id="addPermissionsLink" class="collapse-item" href="/premissions/addpremission">Add Permissions</a>
                <a id="managePermissionsLink" class="collapse-item" href="/premissions/showpremission">Manage Permissions</a>
            </div>
        </div>
    </li>
    {{-- @endif --}}
    <!-- Nav Item - Tables -->

    {{-- @if(Auth::user()->hasRole('admin')) --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
            aria-expanded="true" aria-controls="collapseFour">
            <i class="fas fa-money-check"></i>
            <span>Salaries</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a id="addSalariesLink" class="collapse-item" href="/salaries/addSalaries">Add Salaries</a>
                <a id="manageSalariesLink" class="collapse-item" href="/salaries/showallSalaries">Manage Salaries</a>
            </div>
        </div>
    </li>
    {{-- @endif --}}

    {{-- @if(Auth::user()->hasRole('admin')) --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNine"
            aria-expanded="true" aria-controls="collapseNine">
            <i class="fas fa-cog"></i>
            <span>System Configration</span>
        </a>
        <div id="collapseNine" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">View Logs</a>
                <a class="collapse-item" href="">Manage Settings</a>
            </div>
        </div>
    </li>
    {{-- @endif --}}
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
    </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                        aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="butten">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                        aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                    placeholder="Search for..." aria-label="Search"
                                    aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Nav Item - Alerts -->
                {{-- @if(Auth::user()->hasRole('admin')) --}}
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span class="badge badge-danger badge-counter"></span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Notifications Center
                        </h6>
                            <a class="dropdown-item d-flex align-items-center" href="">
                                <div class="mr-3">
                                    <div class="icon-circle bg">
                                        <i class="text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500"></div>
                                    <span class="font-weight-bold"></span>
                                </div>
                            </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                    </div>
                </li>
                {{-- @endif --}}


                @if(Auth::user()->hasRole('manager'))
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span class="badge badge-danger badge-counter">{{ count($notifications ?? []) }}</span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Notifications Center
                        </h6>
                        @if(isset($notifications))
                            @foreach($notifications as $notification)
                            @if(isset($notification['type']) && isset($notification['icon']) && isset($notification['date']) && isset($notification['message']))
                            <a class="dropdown-item d-flex align-items-center" href="{{route('show.leavereq')}}">
                                <div class="mr-3">
                                    <div class="icon-circle bg-{{ $notification['type'] }}">
                                        <i class="{{ $notification['icon'] }} text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">{{ $notification['date'] }}</div>
                                    <span class="font-weight-bold">{{ $notification['message'] }}</span>
                                </div>
                            </a>
                            @endif
                            @endforeach
                        @endif
                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                    </div>
                </li>
                @endif


                @if(Auth::user()->hasRole('employee'))
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span class="badge badge-danger badge-counter">{{ count(session('notifications.' . Auth::user()->regiuser_id, [])) }}</span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Notifications Center
                        </h6>
                        @foreach(session('notifications.' . Auth::user()->regiuser_id, []) as $notificationn)
                        @if(isset($notificationn['type']) && isset($notificationn['icon']) && isset($notificationn['date']) && isset($notificationn['message']))
                            <a class="dropdown-item d-flex align-items-center" href="/showleavedetails">
                                <div class="mr-3">
                                    <div class="icon-circle bg-{{ $notificationn['type'] }}">
                                        <i class="{{ $notificationn['icon'] }} text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">{{ $notificationn['date'] }}</div>
                                    <span class="font-weight-bold">{{ $notificationn['message'] }}</span>
                                </div>
                            </a>
                        @endif
                        @endforeach
                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                    </div>
                </li>
                @endif


                <!-- Nav Item - Messages -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-envelope fa-fw"></i>
                        <!-- Counter - Messages -->
                        <span class="badge badge-danger badge-counter">7</span>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                            Message Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                    alt="...">
                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div class="font-weight-bold">
                                <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                    problem I've been having.</div>
                                <div class="small text-gray-500">Emily Fowler · 58m</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                    alt="...">
                                <div class="status-indicator"></div>
                            </div>
                            <div>
                                <div class="text-truncate">I have the photos that you ordered last month, how
                                    would you like them sent to you?</div>
                                <div class="small text-gray-500">Jae Chun · 1d</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                    alt="...">
                                <div class="status-indicator bg-warning"></div>
                            </div>
                            <div>
                                <div class="text-truncate">Last month's report looks great, I am very happy with
                                    the progress so far, keep up the good work!</div>
                                <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                    alt="...">
                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div>
                                <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                    told me that people say this to all dogs, even if they aren't good...</div>
                                <div class="small text-gray-500">Chicken the Dog · 2w</div>
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->first_name }}</span>
                        <img class="img-profile rounded-circle"
                            src="img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        {{-- <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset ('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script> --}}

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
    <script>
        document.getElementById('alertsDropdown').addEventListener('click', function() {
        fetch('/clear-notifications').then(response => {
        if (response.ok) {
            document.querySelector('.badge-counter').innerText = '0';
        }
        });
        });
    </script>
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var path = window.location.pathname;

            function expandMenu(linkSelector, collapseSelector, activeLinkId) {
                var menuLink = document.querySelector(linkSelector);
                var collapseElement = document.querySelector(collapseSelector);

                menuLink.classList.remove('collapsed');
                collapseElement.classList.add('show');

                if (activeLinkId) {
                    document.getElementById(activeLinkId).classList.add('active');
                }
            }

            if (path === '/addattandance' || path === '/showallattandance') {
                expandMenu('[data-target="#collapseFive"]', '#collapseFive', path === '/addattandance' ? 'addAttendanceLink' : 'viewAttendanceLink');
            }

            if (path === '/users/newuser' || path === '/users/admincrud') {
                expandMenu('[data-target="#collapseTwo"]', '#collapseTwo', path === '/users/newuser' ? 'addUserLink' : 'manageUsersLink');
            }

            if (path === '/showallleaveReq') {
                expandMenu('[data-target="#collapseSix"]', '#collapseSix', 'viewLeaveApplicationsLink');
            }

            if (path === '/roles/usertype' || path === '/roles/adminrole') {
                expandMenu('[data-target="#collapseOne"]', '#collapseOne', path === '/roles/usertype' ? 'addRolesLink' : 'manageRolesLink');
            }

            if (path === '/premissions/addpremission' || path === '/premissions/showpremission') {
                expandMenu('[data-target="#collapseSeven"]', '#collapseSeven', path === '/premissions/addpremission' ? 'addPermissionsLink' : 'managePermissionsLink');
            }

            if (path === '/salaries/addSalaries' || path === '/salaries/showallSalaries') {
                expandMenu('[data-target="#collapseFour"]', '#collapseFour', path === '/salaries/addSalaries' ? 'addSalariesLink' : 'manageSalariesLink');
            }

            if (path === '/employees/newemp' || path === '/employees/managercrud') {
                expandMenu('[data-target="#collapseTwo"]', '#collapseTwo', path === '/employees/newemp' ? 'addEmployeeLink' : 'manageEmployeeLink');
            }

            if (path === '/createtasks' || path === '/tasks') {
                expandMenu('[data-target="#collapseThree"]', '#collapseThree', path === '/createtasks' ? 'addTasksLink' : 'tasksDetailsLink');
            }

            if (path === '/addattandance' || path === '/showallattandance') {
                expandMenu('[data-target="#collapseFive"]', '#collapseFive', path === '/addattandance' ? 'addAttendanceLink' : 'viewAttendanceLink');
            }

            if (path === '/showmanagersalary') {
                expandMenu('[data-target="#collapseTen"]', '#collapseTen', 'viewMySalaryLink');
            }

            if (path === '/employeecrud') {
                expandMenu('[data-target="#collapseTwo"]', '#collapseTwo', 'viewContactDetailsLink');
            }

            if (path === '/showempsalary') {
                expandMenu('[data-target="#collapseXYZ"]', '#collapseXYZ', 'viewEmpSalaryDetailsLink');
            }

            if (path === '/showempattandance') {
                expandMenu('[data-target="#collapseABC"]', '#collapseABC', 'viewEmpAttendanceDetailsLink');
            }

            if (path === '/showemptask') {
                expandMenu('[data-target="#collapsePQR"]', '#collapsePQR', 'viewEmpTaskDetailsLink');
            }

            if (path === '/showEmpLeave' || path === '/showleavedetails') {
                expandMenu('[data-target="#collapseThree"]', '#collapseThree', path === '/showEmpLeave' ? 'applyLeaveLink' : 'leaveHistoryLink');
            }

        });
    </script>
