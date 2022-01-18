@extends('layouts.main')

@section('container')


<div class="row justify-content-center mb-2 mt-5 mx-1">
    <div class="col-md-4 m-2 ">
        <img src="{{ asset('storage/default/pengepulaksara.png') }}" class="img-fluid" alt="Responsive image">
    </div>
</div>


<div class="row justify-content-center mx-1">
    <div class="col-md-5 mt-2">
    <main class="form-login">
        <h3 class="mb-2 fw-normal text-center">Squy Daftar</h3>
        <form action="/register" method="post">
            @csrf
            <div class="form-floating">
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="name@example.com" name="name" value="{{ old('name') }}" autofocus>
            <label for="name">Nama</label>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-floating">
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="name@example.com" name="username" value="{{ old('username') }}">
            <label for="username">Username</label>
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-floating">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" name="email" value="{{ old('email') }}">
            <label for="email">Alamat Email</label>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-floating">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
            <label for="password">Password</label>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button class="w-100 btn btn-lg btn-dark mt-3 fs-6 bg-black" type="submit">Register</button>
        </form>
        <small class="d-block text-center mt-3">Dah punya akun mah langsung login weh | <a href="/login">Login Hyung!!</a></small>
    </main>
    </div>
</div>



@endsection
