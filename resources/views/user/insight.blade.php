@extends('user.layout')

@section('title', 'Insight Mood - YoMooD')

@section('content')
<div class="p-8 max-w-6xl mx-auto space-y-8 fade-in">

    <!-- Header -->
    <div class="border-b border-gray-200 pb-4">
        <h1 class="text-3xl font-extrabold text-gray-900">Mood Insight</h1>
        <p class="text-gray-600 text-sm mt-1">Lihat pola emosimu dan perjalanan perasaanmu.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm text-center">
            <p class="text-sm text-gray-500">Total Entri</p>
            <p class="text-2xl font-bold text-gray-900">{{ $total ?? 0 }}</p>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm text-center">
            <p class="text-sm text-gray-500">Mood Terbanyak</p>
            <p class="text-xl font-bold text-gray-900">
                @if($mostMood)
                    {{ $mostMood->name }}
                    <span>{{ $emoji[$mostMood->name] ?? '' }}</span>
                @else
                    -
                @endif
            </p>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm text-center">
            <p class="text-sm text-gray-500">Hari Aktif</p>
            <p class="text-2xl font-bold text-gray-900">{{ $activeDays ?? 0 }}</p>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm text-center">
            <p class="text-sm text-gray-500">Streak Terpanjang</p>
            <p class="text-2xl font-bold text-gray-900">{{ $streak ?? 0 }}🔥</p>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Distribution -->
        <div class="bg-white border border-gray-200 p-6 rounded-2xl shadow-lg">
            <h3 class="font-semibold text-lg text-gray-900 mb-4">Distribusi Mood</h3>
            <canvas id="byMoodChart" height="220"></canvas>
        </div>

        <!-- Trend -->
        <div class="bg-white border border-gray-200 p-6 rounded-2xl shadow-lg">
            <h3 class="font-semibold text-lg text-gray-900 mb-4">Tren Mood (14 Hari)</h3>
            <canvas id="trendChart" height="220"></canvas>
        </div>
    </div>

    <p class="text-gray-500 text-sm pt-4">
        👍 Semakin sering kamu tracking mood, semakin akurat insight mood kamu.
    </p>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const moodEmoji = {
        "Bahagia":  "🤩",
        "Senang": "😄",
        "Bimbang": "😕",
        "Cemas": "😰",
        "Biasa Saja": "😐",
        "Sedih": "😢",
        "Sangat Sedih": "😭",
        "Marah": "😠",
        "Sangat Marah": "😡"
    };

    // === Distribusi Mood ===
    const moodLabels = {!! json_encode($byMood->pluck('name')->toArray() ?: []) !!}.map(
        l => `${moodEmoji[l] ?? ''} ${l}`
    );
    const moodData = {!! json_encode($byMood->pluck('jumlah')->toArray() ?: []) !!};

    new Chart(document.getElementById('byMoodChart'), {
        type: 'doughnut',
        data: {
            labels: moodLabels,
            datasets: [{
                data: moodData,
                backgroundColor: ['#FACC15','#FCD34D','#FEF08A','#FCA311','#EAB308','#D97706','#EF4444','#DC2626','#7F1D1D'],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: { position: 'bottom', labels: { font: { size: 13 } } }
            }
        }
    });

    // === Tren ===
    const trendLabels = {!! json_encode($trend->pluck('day')->toArray() ?: []) !!};
    const trendData   = {!! json_encode($trend->pluck('count')->toArray() ?: []) !!};

    new Chart(document.getElementById('trendChart'), {
        type: 'line',
        data: {
            labels: trendLabels,
            datasets: [{
                label: 'Jumlah Entri',
                data: trendData,
                borderColor: '#FACC15',
                backgroundColor: 'rgba(250,204,21,0.25)',
                fill: true,
                tension: .35,
                pointRadius: 5,
                pointBackgroundColor: '#000'
            }]
        },
        options: {
            scales: {
                x: { ticks: { color:'#333' } },
                y: { beginAtZero:true, ticks: { color:'#333' } }
            },
            plugins: {
                legend: { labels: { color:'#333' } }
            }
        }
    });

});
</script>
@endsection
