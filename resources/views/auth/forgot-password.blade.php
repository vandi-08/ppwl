@extends('layouts.guest')

@section('content')

    <h4 class="mb-2">Forgot Password 🔐</h4>
    <p class="mb-4">
        Enter your email so we can send you a password reset link.
    </p>

    @if (session('status'))
        <div class="alert alert-success mb-3">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input 
                type="email" 
                name="email"
                class="form-control"
                value="{{ old('email') }}"
                required
                autofocus
            >
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button class="btn btn-primary w-100">
            Send Reset Link
        </button>

        <p class="text-center mt-3">
            <a href="{{ route('login') }}">Back to Login</a>
        </p>

    </form>

@endsection
