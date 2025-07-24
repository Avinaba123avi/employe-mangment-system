<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    .sort-icon {
        cursor: pointer;
    }
</style>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Role Manager</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Role Types Table</h6>
        </div>
        <div class="card-body p-0 mb-3 mt-3 mr-3">
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search float-right" method="GET" action="{{ route('admin.roles') }}" accept-charset="UTF-8" role="search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                        aria-label="Search" aria-describedby="basic-addon2" name="search" value="{{ request('search')}}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body p-0 mb-0">
            <div class="table-wrapper d-flex flex-col h-100">
                    <table class="table table-striped table-hover table-responsive-xl table-bordered ml-0 mb-0 text-center" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>
                                    UserType Id
                                    <a href="{{ route('admin.roles',array_merge(request()->all(), ['sort' => 'usertype_id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                        <i class="fas fa-sort ml-3 text-muted"></i>
                                    </a>
                                </th>
                                <th>
                                    User Type
                                    <a href="{{ route('admin.roles', array_merge(request()->all(), ['sort' => 'user_type', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                        <i class="fas fa-sort ml-3 text-muted"></i>
                                    </a>
                                </th>
                                <th>Delete</th>
                                <th>Update</th>
                                <th>Add/Edit Role Permission
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $id => $user)
                            <tr>
                                <td>{{ $user->usertype_id }}</td>
                                <td>{{ $user->user_type }}</td>
                                <td><a href="#" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteModal6-{{ $user->usertype_id }}"><i class="fas fa-trash"></i></a></td>
                                <td><a href="{{ route('update.usertype',$user->usertype_id)}}" class="btn btn-warning btn-circle" ><i class="fas fa-user-edit"></i></a></td>
                                <td><a href="{{route('add.permissiontorole',$user->usertype_id)}}" class="btn btn-success"><i class="fas fa-plus-circle"></i></a></td>
                            </tr>
                            <div class="modal fade" id="deleteModal6-{{ $user->usertype_id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel6-{{ $user->usertype_id }}"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel6-{{ $user->usertype_id }}">Ready to Delete the User Role?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Select "Delete" below if you are ready to delete the current role type.</div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <a class="btn btn-primary" href="{{ route('usertype.delete',$user->usertype_id)}}">Delete</a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                         @endforeach
                        </tbody>
                    </table>
            </div>
            <div class="mt-3 ml-2 mr-2">
                {{ $data->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
</div>