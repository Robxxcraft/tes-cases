@extends('layouts.base')

@section('title')
    Login | {{config('app.name')}}
@endsection

@section('body')
<div class="d-flex justify-content-center align-items-center vh-100 vw-100 overflow-hidden">
    <div class="card shadow border-0 w-25">
        <div class="card-body p-4">
            <div class="fs-5 fw-bold text-primary mb-3">Login</div>
            <form action="{{route('login')}}" method="POST">
                @csrf
                <div class="pb-3 position-relative">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" id="email" class="form-control mb-1 {{$errors->has('email') ? 'is-invalid' : ''}}" placeholder="Your email..." aria-label="email">
                    @error('email')
                        <div class="invalid-feedback position-absolute bottom-0">{{$message}}</div>
                    @enderror
                </div>
                <div class="pb-3 position-relative">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control mb-1 {{$errors->has('password') ? 'is-invalid' : ''}}" placeholder="Your password..." aria-label="password">
                    @error('password')
                        <div class="invalid-feedback position-absolute bottom-0">{{$message}}</div>
                    @enderror
                </div>
                <div class="mt-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary fw-semibold">
                        {{-- <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> --}}
                        Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection