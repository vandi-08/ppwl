@extends('layouts.admin')

@section('title', 'Analytics')

@section('content')
<div class="space-y-12">

    <!-- HEADER -->
    <div>
        <h1 class="text-3xl font-bold text-yellow-400">
            Mood Analytics 📊
        </h1>
        <p class="text-gray-400 mt-1">
            Analisis tren, perilaku, dan risiko mood pengguna
        </p>
    </div>

    <!-- TIME FILTER -->
    <div class="flex gap-3">
        <button class="px-4 py-2 bg-yellow-500 text-black rounded-lg text-sm">7 Hari</button>
        <button class="px-4 py-2 bg-gray-800 text-gray-300 rounded-lg text-sm">30 Hari</button>
        <button class="px-4 py-2 bg-gray-800 text-gray-300 rounded-lg text-sm">Semua</button>
    </div>

    <!-- SUMMARY + TREND -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- TOTAL -->
        <div class="bg-black border border-yellow-500 rounded-xl p-6">
            <p class="text-gray-400">Total Input (7 Hari)</p>
            <h2 class="text-4xl font-bold text-yellow-400">
                {{ $weeklyTotal ?? 0 }}
            </h2>
            <p class="text-sm mt-2 text-green-400">
                ↑ {{ $weeklyGrowth ?? 0 }}% dibanding minggu lalu
            </p>
        </div>

        <!-- NEGATIVE -->
        <div class="bg-black border border-red-500 rounded-xl p-6">
            <p class="text-gray-400">Mood Negatif</p>
            <h2 class="text-4xl font-bold text-red-400">
                {{ $weeklyNegative ?? 0 }}
            </h2>
            <p class="text-sm mt-2 text-red-400">
                ↑ {{ $negativeGrowth ?? 0 }}% tren meningkat
            </p>
        </div>

        <!-- ACTIVE TYPES -->
        <div class="bg-black border border-green-500 rounded-xl p-6">
            <p class="text-gray-400">Jenis Mood Aktif</p>
            <h2 class="text-4xl font-bold text-green-400">
                {{ count($moodStats ?? []) }}
            </h2>
            <p class="text-sm mt-2 text-gray-400">
                Berdasarkan input user
            </p>
        </div>
    </div>

    <!-- DISTRIBUSI MOOD -->
    <div class="bg-black border border-yellow-500 rounded-xl p-6">
        <h3 class="text-xl font-semibold text-yellow-400 mb-6">
            Distribusi Mood
        </h3>

        @forelse($moodStats ?? [] as $mood => $count)
            <div class="mb-4">
                <div class="flex justify-between text-sm mb-1">
                    <span>{{ $mood }}</span>
                    <span>{{ $count }}</span>
                </div>

                <div class="w-full bg-gray-800 h-3 rounded-full">
                    <div
                        class="bg-yellow-400 h-3 rounded-full"
                        style="width: {{ min($count * 6, 100) }}%">
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500 italic">Belum ada data mood.</p>
        @endforelse
    </div>

    <!-- INSIGHT AUTO -->
    <div class="bg-black border border-yellow-500 rounded-xl p-6">
        <h3 class="text-xl font-semibold text-yellow-400 mb-4">
            Insight Otomatis 🧠
        </h3>

        <ul class="space-y-2 text-gray-300">
            <li>📌 Mood paling dominan: <strong>{{ $mostMood ?? '-' }}</strong></li>
            <li>📅 Hari paling negatif: <strong>{{ $worstDay ?? '-' }}</strong></li>
            <li>⏰ Jam input tertinggi: <strong>{{ $activeHour ?? '-' }}</strong></li>
            <li>👤 User pasif >7 hari: <strong>{{ $inactiveUsers ?? 0 }}</strong></li>
        </ul>
    </div>

    <!-- WARNING SYSTEM -->
    @if(!empty($warningUsers))
    <div class="bg-red-900/30 border border-red-500 rounded-xl p-6">
        <h3 class="text-xl font-semibold text-red-400 mb-3">
            ⚠️ Warning System
        </h3>

        <ul class="text-gray-200 space-y-1 text-sm">
            @foreach($warningUsers as $user)
                <li>
                    🚨 {{ $user['name'] }} mengalami mood negatif
                    {{ $user['days'] }} hari berturut-turut
                </li>
            @endforeach
        </ul>
    </div>
    @endif

</div>
@endsection
