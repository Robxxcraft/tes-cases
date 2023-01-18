@extends('layouts.base')

@section('body')
<div class="row">
    <nav class="col-md-3 sidebar position-fixed p-3 rounded overflow-hidden">
        <div class="d-flex justify-content-between align-items-center pe-2 mt-1">
            <div class="fs-5 ps-3 text-primary fw-bold">User Management</div>
            <i class="fa-solid fa-bars text-primary fs-4"></i>
        </div>
        <div class="d-flex flex-column pb-3 p-2 h-100">
            <div class="mb-auto mt-5 d-flex flex-column ps-2">
                <a href="/" class="menu p-3 rounded mb-2 {{request()->is('/') ? 'current-menu' : ''}}">
                    <div class="w-100 fw-semibold">
                        <i class="fa-solid fa-house me-2 icon"></i> Home
                    </div>
                </a>
                @auth
                    @if (in_array(Auth::user()->role->role_name, ['Admin', 'Supervisor']))
                        <a href="{{route('user.manage')}}" class="menu p-3 rounded mb-2 {{ request()->is('user-management') || request()->is('user-management/create') || request()->is('user-management/edit/*') ? 'current-menu' : ''}}">
                            <div class="w-100 fw-semibold">
                                <i class="fa-solid fa-users me-2 icon"></i> User Management
                            </div>
                        </a>
                    @endif
                    <a href="{{route('vendor.manage')}}" class="menu p-3 rounded {{request()->is('vendor') || request()->is('vendor/create') ? 'current-menu' : ''}}">
                        <div class="w-100 fw-semibold">
                            <i class="fa-solid fa-file me-2 icon"></i> Vendor
                        </div>
                    </a>
                @endauth
            </div>
            <div class="d-flex flex-column mb-3">
                <a href="#" class=" p-3 rounded mb-2">
                    <div class="w-100 fw-semibold text-dark link">
                        <i class="fa-solid fa-gear me-2 icon"></i>Settings
                    </div>
                </a>
                @auth
                    <a href="{{route('logout')}}" class=" p-3">
                        <div class="w-100 fw-semibold text-danger link">
                            <i class="fa-solid fa-right-from-bracket me-2 icon"></i>Logout
                        </div>
                    </a>
                @endauth
                @guest
                    <a href="{{route('login.form')}}" class="p-3">
                        <div class="w-100 fw-semibold text-success link">
                            <i class="fa-solid fa-right-to-bracket me-2 icon"></i>Login
                        </div>
                    </a>
                @endguest
            </div>
        </div>
    </nav>
    <div class="col-12 col-md-9 ms-auto vh-100 main me-4 pe-4">
        @yield('content')
    </div>
</div>
@endsection