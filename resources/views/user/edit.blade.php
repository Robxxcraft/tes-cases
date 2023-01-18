@extends('layouts.app')

@section('title')
    Edit User | {{config('app.name')}}
@endsection

@section('content')
    <div class="ms-3">
        <div class="d-flex justify-content-end mt-4">
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/user-management">User Management</a></li>
                    <li class="breadcrumb-item active text-primary fw-bold" aria-current="page">Edit</li>
                </ol>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="mt-3 card w-50 border-0 shadow-sm">
                <div class="card-body position-relative">
                    <a href="/user-management" class="position-absolute left-0 top-0 ms-2 p-3 text-dark"><i class="fa-solid fa-arrow-left"></i></a>
                    <div class="text-center text-primary fw-bold">Edit User</div>
                    <form action="{{route('user.update', $user->id)}}" method="POST" class="p-3">
                        @csrf
                        @method('PUT')
                        <div class="pb-3 position-relative">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control mb-1 {{ $errors->has('username') ? 'is-invalid' : ''}}" placeholder="Username" aria-label="username" autocomplete="false" value="{{$user->username}}">
                            @error('username')
                                <div class="invalid-feedback position-absolute bottom-0 ps-2">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="pb-3 position-relative">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" id="email" class="form-control mb-1 {{ $errors->has('email') ? 'is-invalid' : ''}}" placeholder="Email" aria-label="email" value="{{$user->email}}">
                            @error('email')
                                <div class="invalid-feedback position-absolute bottom-0 ps-2">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="pb-3 position-relative">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control mb-1 {{ $errors->has('password') ? 'is-invalid' : ''}}" placeholder="Password" aria-label="password" value="{{$user->password}}">
                            @error('password')
                                <div class="invalid-feedback position-absolute bottom-0 ps-2">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="pb-3 position-relative">
                            <label for="role" class="form-label">Role</label>
                            <select name="role_id" id="role_id" class="form-select mb-1 {{ $errors->has('role') ? 'is-invalid' : ''}}">
                                <option selected>Choose...</option>
                                @foreach ($roles as $role)
                                    @if ($user->role->role_name == $role->role_name)
                                        <option value="{{$role->id}}" selected>{{$role->role_name}}</option>
                                    @else
                                        <option value="{{$role->id}}">{{$role->role_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('role')
                                <div class="invalid-feedback position-absolute bottom-0 ps-2">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mt-2 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary fw-semibold">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection