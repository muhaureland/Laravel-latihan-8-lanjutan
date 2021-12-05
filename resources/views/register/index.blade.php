@extends('layouts.main')
@section('container')
    <div class="row justify-content-center">
        <div class="col-md-5">
            <main class="form-registration">
                <h1 class="h3 mb-3 fw-normal">Please registrasi</h1>
                <form action="/register" method="POST">
                    @csrf
                    <div class="form-floating">
                        <input type="text" class="form-control @error('name') is-invalid @enderror rounded-top" name="name" id="name" placeholder="namaa" value="{{ old('name') }}">
                        <label for="name">nama</label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="namaa" value="{{ old('username') }}">
                        <label for="username">username</label>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="email" value="{{ old('email') }}">
                        <label for="email">Email address</label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="Password">
                        <label for="password">Password</label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="w-100 btn btn-lg btn-primary mt-" type="submit">Daftar</button>
                </form>
                <small class="d-block text-center mt-3">sudah punya akun ? <a href="/login">Login</a></small>
            </main>
        </div>
    </div>
@endsection