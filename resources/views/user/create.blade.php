@extends('layouts.app')

@section('title')
    Create User | {{config('app.name')}}
@endsection

@section('content')
    <div class="ms-3">
        <div class="d-flex justify-content-end mt-4">
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('user.manage')}}">User Management</a></li>
                    <li class="breadcrumb-item active text-primary fw-bold" aria-current="page">Create</li>
                </ol>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="mt-3 card w-50 border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-center fw-bold text-primary">Create New User</div>
                    <form action="{{route('user.createPost')}}" method="POST" class="p-3">
                        @csrf
                        <div class="pb-3 position-relative">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control mb-1 {{ $errors->has('username') ? 'is-invalid' : ''}}" placeholder="Enter username here..." aria-label="username" autocomplete="false" value="{{old('username')}}">
                            @error('username')
                                <div class="invalid-feedback position-absolute bottom-0 ps-2">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="pb-3 position-relative">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" id="email" class="form-control mb-1 {{ $errors->has('email') ? 'is-invalid' : ''}}" placeholder="Enter email here..." aria-label="email" value="{{old('email')}}">
                            @error('email')
                                <div class="invalid-feedback position-absolute bottom-0 ps-2">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="pb-3 position-relative">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" name="password" id="password" class="form-control mb-1 {{ $errors->has('password') ? 'is-invalid' : ''}}" placeholder="Enter password here..." aria-label="password" value="{{old('password')}}">
                            @error('password')
                                <div class="invalid-feedback position-absolute bottom-0 ps-2">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="pb-3 position-relative">
                            <label for="role" class="form-label">Role</label>
                            <select name="role_id" id="role_id" class="form-select mb-1 {{ $errors->has('role_id') ? 'is-invalid' : ''}}">
                                <option selected value="">Choose...</option>
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->role_name}}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <div class="invalid-feedback position-absolute bottom-0 ps-2">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mt-2 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary fw-semibold">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection