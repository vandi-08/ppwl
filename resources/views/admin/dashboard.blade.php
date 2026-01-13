@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')

<<<<<<< HEAD
<div class="container-xxl flex-grow-1 container-p-y">
    <h1>Selamat datang di halaman Dashboard UTS PPWL</h1>
=======
<h1 class="text-3xl font-bold mb-8">Dashboard Admin </h1>

<!-- STAT CARDS -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- Total Users -->
    <div class="bg-black rounded-xl p-6 shadow border border-yellow-500">
        <h3 class="text-lg text-yellow-400">Total Users</h3>
        <p class="text-4xl font-bold mt-2">{{ $totalUsers }}</p>
    </div>

    <!-- Mood Entries -->
    <div class="bg-black rounded-xl p-6 shadow border border-yellow-500">
        <h3 class="text-lg text-yellow-400">Mood Entries</h3>
        <p class="text-4xl font-bold mt-2">{{ $totalMoods }}</p>
    </div>

    <!-- Aktivitas -->
    <div class="bg-black rounded-xl p-6 shadow border border-yellow-500">
        <h3 class="text-lg text-yellow-400">Aktivitas</h3>
        <p class="text-4xl font-bold mt-2">{{ $totalActivities }}</p>
    </div>

</div>

<!-- NEGATIVE MOOD -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-black rounded-xl p-6 shadow border border-red-500">
        <h3 class="text-lg text-red-400">Mood Negatif (7 Hari)</h3>
        <p class="text-4xl font-bold mt-2 text-red-400">{{ $negativeMoods }}</p>
    </div>
</div>

<!-- INSIGHT -->
<div class="mt-10 bg-black rounded-xl p-6 border border-yellow-500">
    <h2 class="text-xl font-semibold mb-4">Insight Sistem 🧠</h2>

    <ul class="space-y-2 text-yellow-300">
        <li>📌 Mood paling sering: <strong>{{ $topMoodName ?? '-' }}</strong>
        <li>📌 Jam paling aktif: <strong>{{ $activeHour }}:00</strong></li>
        <li>📌 User tidak aktif 7 hari: <strong>{{ $inactiveUsers }}</strong></li>
    </ul>
</div>

<!-- ACTION -->
<div class="mt-10">
    <a href="{{ route('admin.activities') }}"
       class="bg-yellow-400 text-black px-6 py-3 rounded-lg font-semibold hover:bg-yellow-500 transition">
        Kelola Aktivitas
    </a>
>>>>>>> 1394cbb (Add Laravel project files)
</div>

@endsection
