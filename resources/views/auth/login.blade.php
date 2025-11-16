@extends('layouts.guest')

@section('content')

    <h4 class="mb-2">Welcome Back 👋</h4>
    <p class="mb-4">Please sign in to your account</p>

    @if (session('status'))
        <div class="alert alert-success mb-4">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control" type="email"
                   name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input class="form-control" type="password" name="password" required>
        </div>

        <div class="d-flex justify-content-end mb-3">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Forgot password?</a>
            @endif
        </div>

        <button class="btn btn-primary w-100">Log in</button>

        <p class="text-center mt-3">
            Don't have an account?
            <a href="{{ route('register') }}">Create an account</a>
        </p>

    </form>

@endsection
