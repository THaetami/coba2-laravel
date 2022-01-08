@extends('layouts.main')

@section('container')


<div class="row justify-content-first mb-0 mt-3">
    <div class="col-lg-8 m-0">
        <img src="{{ asset('storage/default/pengepulaksara.png') }}" class="img-fluid" alt="Responsive image">
    </div>
</div>

<div class="row justify-content-end m-1 mt-3">

    <div class="col-md-4 m-2">

        {{-- pesan saat registrasi berhasil --}}
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        {{-- pesan saat login gagal --}}
        @if (session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif




        <main class="form-login m-0">

            <h2 class="mb-3 fw-normal text-center">Squy Login</h2>
            <form action="/login" method="post">

                @csrf
                <div class="form-floating">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" name="email" value="{{ old('email') }}" autofocus required>
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

                <button class="w-100 btn btn-lg btn-dark mt-3 fs-6 bg-black" type="submit">Login</button>
            </form>

             <small class="d-block text-center  text-danger mt-3">Belum punya akun? <a href="/register">Squy daptar!!</a></small>

        </main>
    </div>
</div>




@endsection
