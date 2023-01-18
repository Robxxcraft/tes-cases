@extends('layouts.app')

@section('title')
    Home | {{config('app.name')}}
@endsection

@section('content')
    <div class="h-100 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="d-flex flex-row flex-sm-column justify-content-center align-items-center">
                        <div class="card w-33 m-3 border-0 bg-primary text-white shadow rounded d-inline-block p-2">
                            <div class="card-body text-center">
                                <i class="fa-solid fa-users me-2 icon fs-3 mb-2"></i>
                                <div class="fw-bold fs-5">{{$user_total}} Users</div>
                            </div>
                        </div>
                        <div class="card w-33 m-3 border-0 bg-primary text-white shadow rounded d-inline-block p-2">
                            <div class="card-body text-center">
                                <i class="fa-solid fa-file me-2 icon fs-3 mb-2"></i>
                                <div class="fw-bold fs-5">{{$file_total}} Files</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 mt-3">
                    @auth
                    <div class="card border-0 rounded shadow-sm">
                        <div class="card-body">
                            <div class="fw-bold text-primary ps-3 mb-2">Profile</div>
                            <div class="d-flex align-items-center">
                                <div class="text-dark mx-3">   
                                    <i class="fa-solid fa-user fs-4"></i>
                                </div>
                                <div>
                                <div class="mb-1 d-flex align-items-end">
                                    <div class="fw-semibold">{{Auth::user()->username}}</div>
                                    <div class="badge bg-primary ms-1">{{Auth::user()->role->role_name}}</div>
                                </div>
                                <div class="text-dark">{{Auth::user()->email}}</div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    @endauth
                    @guest
                    <div class="fw-bold text-primary fs-5">User Management</div>
                    <div class="text-break mt-3 mb-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium, facilis blanditiis. Officiis tempora totam placeat provident repellendus ab quasi deleniti ratione? Ut similique quasi numquam. Perspiciatis quam et accusamus illo?</div>
                    <a href="{{route('login.form')}}" class="btn btn-primary fw-semibold shadow mt-4">Get Started</a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
@endsection