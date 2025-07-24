<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    .sort-icon {
        cursor: pointer;
    }
</style>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Employee Details</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">My Information</h6>
        </div>
        <div class="card-body p-0 mb-0">
            <div class="table-wrapper d-flex flex-col h-100">
                    <table class="table table-striped table-hover table-bordered ml-0 mb-0 text-center" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>
                                    RegisterUser Id
                                </th>
                                <th>
                                    UserType Id
                                </th>
                                <th>
                                    First Name
                                </th>
                                <th>
                                    Last Name
                                </th>
                                <th>
                                    Email Id
                                </th>
                                <th>Back</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ Auth::user()->regiuser_id }}</td>
                                <td>{{ Auth::user()->usertype_id }}</td>
                                <td>{{ Auth::user()->first_name }}</td>
                                <td>{{ Auth::user()->last_name }}</td>
                                <td>{{ Auth::user()->email }}</td>
                                <td><a href="/employee" class="btn btn-success"><i class="fas fa-arrow-circle-left"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>


