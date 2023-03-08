@extends('admin.layout.navFooter')
@section('admin-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto my-5">
                <div class="card">
                    <div class="card-header bg-info text-light">
                        Createpermission
                    </div>
                    <div class="card-body">
                       
                        <form action="{{ route('insert.permission') }}" method="POST">
                            @csrf

                                
                                <label for="role_name">select a role</label>
                                <select name="role_name" id="role_name" class="mb-2 form-control">
                                    <option value="" selected disabled>choose a role</option>
                                     @foreach ($roles as $role)
                                       <option value="{{ $role->id }}">{{ $role->name }}</option>
                                     @endforeach
                                    </select>
                                @error('role_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <label for="name">User Name</label>
                                <input type="text" class="form-control mb-2" placeholder="enter a user name" name="name" id="name">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <label for="name">User Email</label>
                                <input type="email" class="form-control mb-2" placeholder="enter a user email" name="email" id="email">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <label for="password">User Password</label>
                                <input type="password" class="form-control mb-2" placeholder="provide a password" name="password" id="password">
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <button class="btn btn-primary text-light px-5 w-100">submit</button>

                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection