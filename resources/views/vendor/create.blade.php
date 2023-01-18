@extends('layouts.app')

@section('title')
    Create File | {{config('app.name')}}
@endsection

@section('content')
    <div class="ms-3">
        <div class="d-flex justify-content-end mt-4">
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('vendor.manage')}}">Vendor</a></li>
                    <li class="breadcrumb-item active text-primary fw-bold" aria-current="page">Create</li>
                </ol>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="mt-3 card w-50 border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-center fw-bold text-primary">Create New file</div>
                    <form action="{{route('vendor.create')}}" method="POST" enctype="multipart/form-data" class="p-3">
                        @csrf
                        <div class="pb-3 position-relative">
                            <label for="quantity" class="form-label">Quantity goods</label>
                            <input type="number" name="goods_qty" id="goods_qty" class="mb-1 form-control mb-1 {{ $errors->has('goods_qty') ? 'is-invalid' : ''}}" placeholder="Enter quantity here..." aria-label="quantity" autocomplete="false">
                            @error('goods_qty')
                                <div class="invalid-feedback position-absolute bottom-0 ps-2">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="pb-3 position-relative">
                            <label for="file" class="form-label">File</label>
                            <input type="file" name="file" class="mb-1 form-control {{ $errors->has('file') ? 'is-invalid' : ''}}">
                            @error('file')
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