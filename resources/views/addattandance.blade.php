<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    {{-- <style>
        /* Custom styles to ensure the table fits within the screen */
        table {
            width: 100%; /* Set table width to 100% */
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            word-wrap: break-word; /* Ensure text wraps within cells */
            white-space: normal;/* Allow line breaks within cells */
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .table th, .table td {
            white-space: nowrap;
        }
        .table td.password-column {
            width: 300px; /* Set a maximum width */
            word-break: break-all; /* Break long words */
            white-space: normal; /* Allow line breaks within cells */
            text-align: center;
        }
    </style> --}}

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layouts.allnavigation')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Add Attendance Details</h1>
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
                            <h6 class="m-0 font-weight-bold text-primary">Add Attendance</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.attandance')}}" class="user" method="POST">
                                @csrf
                                <div class="form-group row d-flex justify-content-center">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <label for="date" class="form-label form-control-user">Date</label>
                                        <input type="date" name="date" id="date" class="form-control form-control-user @error('date') is-invalid @enderror">
                                        @error('date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="table-wrapper d-flex flex-col h-100">
                                    <table class="table table-striped table-hover table-bordered ml-0 mb-0 text-center" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>User Type ID</th>
                                                <th>User ID</th>
                                                <th>Name</th>
                                                <th>Present</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($employees as $employee)
                                            <tr>
                                                <td>{{ $employee->usertype_id }}</td>
                                                <td>{{ $employee->regiuser_id }}</td>
                                                <td>{{ $employee->first_name }}</td>
                                                <td>
                                                    <select name="attendance[{{ $employee->regiuser_id }}][status]" class="form-control">
                                                        <option value="present">Present</option>
                                                        <option value="absent">Absent</option>
                                                        <option value="leave">Leave</option>
                                                    </select>
                                                    <input type="hidden" name="attendance[{{ $employee->regiuser_id }}][regiuser_id]" value="{{ $employee->regiuser_id }}">
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center mt-3">
                                    <button type="submit" href="/managercrud" class="btn btn-primary btn-user btn-lg">Take Today's Attendance</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('layouts.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('user.logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
