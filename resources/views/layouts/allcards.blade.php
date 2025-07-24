{{-- @if(Auth::user()->hasRole('admin')) --}}
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Admin Dashboard</h1>
    </div>

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->

        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Managers (Total Managers)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $managers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tasks Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Employees (Total Employees)
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $employees }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-friends fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ url('/users/admincrud') }}" class="text-decoration-none">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Number Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalusers}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ url('/showallSalaries') }}" class="text-decoration-none">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Salary of All the Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹{{ number_format($salaries, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-rupee-sign fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>

    </div>
    </div>
</div>
<div class="row ml-3">
<div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Salary Overview</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Dropdown Header:</div>
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-area">
                <canvas id="myAreaChart"></canvas>
            </div>
        </div>
    </div>
    
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fetching the data from the server-side
        var employeeNames = @json($employeeNames); // e.g., ['John', 'Doe', 'Jane', 'Smith']
        var employeeSalaries = @json($employeeSalaries); // e.g., [50000, 60000, 75000, 80000]
    
        // Chart.js script
        var ctx = document.getElementById("myAreaChart").getContext('2d');
        var myAreaChart = new Chart(ctx, {
            type: 'line', // 'line' for area chart
            data: {
                labels: employeeNames,
                datasets: [{
                    label: "Salary",
                    data: employeeSalaries,
                    backgroundColor: "rgba(78, 115, 223, 0.2)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                }],
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    x: {
                        type: 'category',
                        title: {
                            display: true,
                            text: 'Employee Name'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Salary'
                        }
                    }
                }
            }
        });
    });
    </script>

{{-- @endif --}}

@if(Auth::user()->hasRole('manager'))
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manager Dashboard</h1>
    </div>

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->


        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ url('/showallleaveReq') }}" class="text-decoration-none">
            <div class="card border-left-success shadow h-100 py-2 card-leaves">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Leaves (Total Number of Leaves)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $leaves }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <!-- Tasks Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ url('/managercrud') }}" class="text-decoration-none">
            <div class="card border-left-info shadow h-100 py-2 card-tasks ">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Employees (Total Employees)
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $employees }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-friends fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2 card-salary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Salary of the employess</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹{{ number_format($salaries, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-check-alt fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

</div>
<style>
    .card-leaves {
        background-color: #e3f2fd;
    }
    .card-leaves:hover {
        background-color: #bbdefb;
    }
    
    .card-tasks {
        background-color: #e8f5e9;
    }
    .card-tasks:hover {
        background-color: #c8e6c9;
    }
    
    .card-salary {
        background-color: #fff3e0;
    }
    .card-salary:hover {
        background-color: #ffe0b2;
    }
</style>
@endif

@if(Auth::user()->hasRole('employee'))
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Employee Dashboard</h1>
    </div>

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ url('/showleavedetails') }}" class="text-decoration-none">
            <div class="card border-left-primary shadow h-100 py-2 card-leaves">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                My Number Of Leaves</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$leaves}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-share fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ url('/showemptask') }}" class="text-decoration-none">
            <div class="card border-left-primary shadow h-100 py-2 card-tasks">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                My Tasks</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                   {{ $taskCount }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tasks fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <!-- Earnings (Annual) Card Example -->

        <!-- Tasks Card Example -->
        
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ url('/showempsalary') }}" class="text-decoration-none">
            <div class="card border-left-warning shadow h-100 py-2 card-salary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                My Salary</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $salary ? '₹' . number_format($salary->amount, 2) : 'N/A' }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-check-alt fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>

    </div>

</div>

<style>
    .card-leaves {
        background-color: #e3f2fd;
    }
    .card-leaves:hover {
        background-color: #bbdefb;
    }
    
    .card-tasks {
        background-color: #e8f5e9;
    }
    .card-tasks:hover {
        background-color: #c8e6c9;
    }
    
    .card-salary {
        background-color: #fff3e0;
    }
    .card-salary:hover {
        background-color: #ffe0b2;
    }
</style>
@endif