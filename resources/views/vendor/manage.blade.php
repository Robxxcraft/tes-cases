@extends('layouts.app')

@section('title')
    Vendor | {{config('app.name')}}
@endsection

@section('content')
    <div class="d-flex justify-content-end mt-4">
        <div aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active text-primary fw-bold" aria-current="page">Vendor</li>
            </ol>
        </div>
    </div>
    <div class="container mt-3 g-5 ms-2 p-3">
        <div class="d-flex align-items-end {{in_array(auth()->user()->role->role_name, ['Admin', 'Supervisor']) ? 'justify-content-between' : 'justify-content-end'}} mb-3 mx-3">
            @if (in_array(auth()->user()->role->role_name, ['Admin', 'Supervisor']))
                <a href="{{route('vendor.create')}}" class="fw-semibold text-decoration-underline">Create new file</a>
            @endif
            <div class="input-group w-25" x-data="{search: ''}">
                <input x-model="search" type="text" placeholder="Search..." class="form-control bg-white">
                <a x-bind:href="'/vendor?search='+search" class="input-group-text btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></a>
            </div>
        </div>
        
        @if (session()->has('alert'))
            <div x-data="{isActive: true}" x-show="isActive" class="alert alert-success alert-dismissible fade show" role="alert">
                {{session()->get('alert')}}
                <button x-on:click.prevent="isActive = false" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row gy-md-2 gy-3 align-items-stretch">
            @foreach ($files as $file)
                <div class="col-12 col-md-4 h-100">
                    <div class="h-100 card rounded border-0">
                        <div class="card-body">
                            @if (Auth::user()->role->role_name == 'Supervisor')
                                <div class="mb-3 d-flex justify-content-end">
                                    <a href="{{route('vendor.download', $file->id)}}" class="me-3"><i class="fa-solid fa-download"></i></a>
                                </div>
                            @endif
                            <div class="fw-semibold mb-2">{{$file->filename}}</div>
                            <div class="text-dark">{{$file->path}}</div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="mt-4 d-flex justify-content-end">
                {{$files->links()}}
            </div>
        </div>
    </div>
@endsection