@extends('layouts.guest')

@section('background', 'login')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-md-8">
            <div class="d-flex flex-column justify-content-center vh-100">
                <p class="fw-bold fs-1 mb-5"><span class="text-black">BRAINSTER</span><span class="text-gray">PRENEURS</span></p>
                <p class="fs-4 fw-semibold">Propel your ides to life!</p>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <form action="{{ route('login') }}" method="POST" class="d-flex flex-column justify-content-center vh-100">
                @csrf
                @method('POST')
                <div class="h1 fw-bolder">Login</div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com">
                    <label for="email">Email address</label>
                    @error('email')
                    <div class="small text-red mb-0">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" placeholder="Password">
                    <label for="password">Password</label>
                    @error('password')
                    <div class="small text-red mb-0">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn bg-orange text-white fw-semibold text-uppercase mb-4">Login</button>
                <div class="mb-0">Don't have an account?
                    <a href="{{ route('register') }}" class="text-gray">Register here!</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection