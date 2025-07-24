<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Employee Dashboard</h1>
    </div>

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
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
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
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
        </div>

        <!-- Earnings (Annual) Card Example -->

        <!-- Tasks Card Example -->
        
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
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