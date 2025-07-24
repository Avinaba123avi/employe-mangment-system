<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    .sort-icon {
        cursor: pointer;
    }
    .status-circle {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border-radius: 50%;
        }
        .badge-pending {
            background-color: #FFD580; /* Lighter orange */
            color: black;
        }
        .badge-in-progress {
            background-color: #ADD8E6; /* Lighter blue */
            color: black;
        }
        .badge-completed {
            background-color: #90EE90; /* Lighter green */
            color: black;
        }
</style>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">My Attendance Details</h1>
            @if (session()->has('success'))
            <div class="alert alert-success success-message text-center mx-auto">
                {{ session('success') }}
            </div>
            @endif
            @if (session()->has('status'))
            <div class="alert alert-success success-message text-center mx-auto">
                {{ session('status') }}
            </div>
            @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">My Attendance Table</h6>
        </div>
        {{-- <div class="card-body p-0 mb-3 mt-3 mr-3">
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search float-right" method="GET" action="{{ route('attandance.employee') }}" accept-charset="UTF-8" role="search">
                <div class="input-group">
                    <input type="date" class="form-control bg-light border-0 small" aria-label="Search by date" aria-describedby="basic-addon2" name="date" value="{{ request('date') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div> --}}
        <div class="card-body p-0 mb-0">
            <div class="table-wrapper d-flex flex-col h-100">
                    <table class="table table-striped table-hover table-bordered ml-0 mb-0 text-center" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>
                                    Attendance ID
                                    <a href="{{ route('attandance.employee',array_merge(request()->all(), ['sort' => 'attendance_id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                        <i class="fas fa-sort ml-3 text-muted"></i>
                                    </a>
                                </th>
                                <th>
                                    Date
                                    <a href="{{ route('attandance.employee',array_merge(request()->all(), ['sort' => 'date', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                        <i class="fas fa-sort ml-3 text-muted"></i>
                                    </a>
                                </th>
                                <th>
                                    Attendance
                                    <a href="{{ route('attandance.employee',array_merge(request()->all(), ['sort' => 'status', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                        <i class="fas fa-sort ml-3 text-muted"></i>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @if ($attendances->isEmpty())
                            <tr>
                                <td colspan="7">
                                    <div class="alert alert-info text-center mt-4">
                                        No attendance records found.
                                    </div>
                                </td>
                            </tr>
                        @else
                            @foreach ($attendances as $attendance)
                            <tr>
                                <td>{{ $attendance->attendance_id }}</td>
                                <td>{{ $attendance->date  }}</td>
                                <td>{{ $attendance->status }}</td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    
            </div>
            <div class="mt-3 ml-2 mr-2">
                {{ $attendances->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
</div>


