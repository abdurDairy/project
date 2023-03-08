@extends('admin.layout.navFooter')
@section('admin-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto my-5">
                <div class="card">
                    {{-- seccess message --}}
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="card-header d-block">
                        Admin List
                        <a href="{{ route('path.role') }}" class="btn btn-primary px-5 py-2 position-absolute top-0 end-0">Create a role</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-responsive">
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                        </div>
                                    </td>
                                    <td>
                                            <a href="" class="btn btn-primary btn-sm">Edit</a>
                                    </td>
                                    <td>
                                            <a href="" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection