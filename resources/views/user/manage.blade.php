@extends('layouts.app')

@section('title')
    Manage User | {{config('app.name')}}
@endsection

@section('content')
    <div class="d-flex justify-content-end mt-4">
        <div aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active text-primary fw-bold" aria-current="page">User Management</li>
            </ol>
        </div>
    </div>
    <div class="container mt-3 ms-2 p-3">
        <div class="d-flex align-items-end {{auth()->user()->role->role_name == 'Supervisor'? 'justify-content-between' : 'justify-content-end'}} mb-3 mx-3">
            @if (auth()->user()->role->role_name == 'Supervisor')
                <a href="{{route('user.create')}}" class="fw-semibold text-decoration-underline">Create new user</a>
            @endif
            <div class="input-group w-25" x-data="{search: ''}">
                <input x-model="search" type="text" placeholder="Search..." class="form-control bg-white">
                <a x-bind:href="'/user-management?search='+search" class="input-group-text btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></a>
            </div>
        </div>

        @if (session()->has('alert'))
            <div x-data="{isActive: true}" x-show="isActive" class="alert {{session()->get('alert-class')}} alert-dismissible fade show" role="alert">
                {{session()->get('alert')}}
                <button x-on:click.prevent="isActive = false" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="table-responsive">
            
        <table class="rounded table table-hover overflow-hidden shadow-sm">
            <thead>
                <tr class="bg-primary text-white">
                    <th class="px-3">#</th>
                    <th class="px-3">Username</th>
                    <th class="px-3">Email</th>
                    <th class="px-3">Role</th>
                    <th class="px-3">Password</th>
                    @if (auth()->user()->role->role_name == 'Supervisor')
                        <th class="px-3">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $user)
                    <tr>
                        <td class="px-3 text-primary fw-semibold">{{$user->id}}</td>
                        <td class="px-3 fw-semibold text-break">{{$user->username}}</td>
                        <td class="px-3">{{$user->email}}</td>
                        <td class="px-3"><span class="badge bg-primary">{{$user->role->role_name}}</span></td>
                        <td class="px-3 overflow-hidden">
                            <div class="text-dark text-break">{{$user->password}}</div>
                        </td>
                        @if (auth()->user()->role->role_name == 'Supervisor')
                            <td class="px-3">
                                <div class="d-flex align-items-center">
                                    <a href="{{route('user.edit', $user->id)}}" class="rounded btn me-2 btn-warning px-2 py-1 text-white">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                    <a href="{{route('user.delete', $user->id)}}" class="rounded btn btn-danger px-2 py-1 text-white">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        
        <div class="mt-4 d-flex justify-content-end">{{$data->links()}}</div>
    </div>
@endsection