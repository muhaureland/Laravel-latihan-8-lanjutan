@extends('layouts.main')
@section('container')
    <div class="row justify-content-center">
        <div class="col-md-5">
            @if (session('status'))
            <div class="alert alert-success mb-1">
                {{ session('status') }}
            </div>
            @endif
            @if (session('gagal'))
            <div class="alert alert-danger mb-1">
                {{ session('gagal') }}
            </div>
            @endif
            <main class="form-signin">
                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
                <form action="/login" method="POST">
                    @csrf
                    <div class="form-floating">
                        <input type="email" class="form-control" @error('email') is-invalid @enderror name="email" id="email" placeholder="name@example.com" required autofocus value="{{ old('email') }}">
                        <label for="email">Email address</label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" @error('password') is-invalid @enderror name="password" id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
                </form>
                <small class="d-block text-center mt-3">not register ? <a href="/register">registrasi sekarang</a></small>
            </main>
        </div>
    </div>
@endsection