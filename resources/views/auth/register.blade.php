@extends('layouts.guest')

@section('background', 'register')

@section('content')
<div class="container">
    <div class="row py-4">
        <div class="col-12 col-md-6">
            <h1 class="fw-bolder mb-3">Register</h1>

            <form action="#" method="POST" class="row g-2">
                @csrf
                @method('POST')
                <div class="col-md-6 mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="name" name="name" placeholder="John" value="{{ old('name') }}">
                        <label for="name">Name</label>
                        @error('name')
                        <div class="small text-red mb-0">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Doe" value="{{ old('surname') }}">
                        <label for="surname">Surname</label>
                        @error('surname')
                        <div class="small text-red mb-0">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}">
                        <label for="email">Email address</label>
                        @error('email')
                        <div class="small text-red mb-0">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" placeholder="Password">
                        <label for="password">Password</label>
                        @error('password')
                        <div class="small text-red mb-0">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Biography" id="biography" name="biography" value="{{ old('biography') }}" style="height: 220px; resize:none;"></textarea>
                        <label for="biography">Biography</label>
                        @error('biography')
                        <div class="small text-red mb-0">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <button type="submit" class="btn text-white text-uppercase fw-semibold bg-green btn-xl mb-3">Register</button>
                    <div class="mb-0">Already registered?
                        <a href="{{ route('login') }}" class="text-gray">Login here!</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection