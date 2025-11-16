@extends('layouts.admin')

@section('title', 'User Dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">User Dashboard</h4>
    <p>Welcome, {{ Auth::user()->name }}!</p>
</div>
@endsection
