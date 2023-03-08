@extends('admin.layout.navFooter')
@section('admin-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto my-5">
                <div class="card">
                    <div class="card-header bg-info text-light">
                        Create a Role
                    </div>
                    <div class="card-body">
                        <form action="{{ route('insert.role') }}" method="post">
                            @csrf
                            <label for="role-name">Create a role</label>
                            <input type="text" class="form-control my-2" placeholder="enter a role name" name="role_name">

                            @error('role_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <button class="btn btn-primary text-light px-5">submit</button>
                        </form>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection