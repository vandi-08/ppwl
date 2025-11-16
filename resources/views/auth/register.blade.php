@extends('layouts.guest')

@section('content')

    <h4 class="mb-2">Create an account 🚀</h4>
    <p class="mb-4">Please fill the form below</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input 
                type="text" 
                class="form-control" 
                name="name" 
                required autofocus>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input 
                type="email" 
                class="form-control" 
                name="email" 
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input 
                type="password" 
                class="form-control" 
                name="password" 
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input 
                type="password" 
                class="form-control" 
                name="password_confirmation" 
                required>
        </div>

        <button class="btn btn-primary d-grid w-100">Register</button>

        <p class="text-center mt-3">
            Already have an account?
            <a href="{{ route('login') }}">Login</a>
        </p>

    </form>

@endsection
