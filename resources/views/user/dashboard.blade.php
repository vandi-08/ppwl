<<<<<<< HEAD
@extends('layouts.user.app')
=======
@extends('user.layout')
>>>>>>> 1394cbb (Add Laravel project files)

@section('title', 'Dashboard')

@section('content')
<<<<<<< HEAD
<div class="container py-5">
    <h1>Dashboard User</h1>
    <p>Halaman setelah login.</p>
</div>
=======

<style>
/* Smooth entrance animation */
.fade-in { animation: fadeIn .6s ease-out forwards; opacity:0; }
@keyframes fadeIn { from {opacity:0; transform:translateY(10px);} to {opacity:1; transform:translateY(0);} }

/* Soft glass UI */
.glass {
    background: rgba(255,255,255,0.06);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0);
    border-radius: 18px;
}

/* Mood button interaction */
.mood-btn {
    transition: .25s;
    min-width: 85px;
    padding: 16px;
    cursor: pointer;
    border-radius: 18px;
}
.mood-btn:hover {
    transform: scale(1.12);
    filter: drop-shadow(0 0 6px rgba(255,255,50,0.4));
}

/* Journal text improvements */
textarea {
    overflow: hidden;
    resize: none;
    line-height: 1.5;
    font-size: 15px;
}

/* List UI clarity */
ul li {
    font-size: 15px;
    line-height: 1.55;
}

/* Hide scrollbar */
.scrollbar-hide::-webkit-scrollbar { display: none; }

/* =======================
   POPUP
======================= */
#moodPopup {
    position: fixed;
    inset: 0;
    width: 100%; height: 100%;
    display: none;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(6px);
    background: rgba(0,0,0,0.45);
    z-index: 9999;
    animation: fadeIn .3s ease-out;
}

#moodPopup .popup-box {
    background: rgba(255,255,255,0.12);
    border: 1px solid rgba(255,255,255,0.25);
    backdrop-filter: blur(12px);
    padding: 28px;
    border-radius: 20px;
    width: 90%;
    max-width: 420px;
    color: white;
    text-align: center;
    animation: slideUp .4s ease-out;
}

#moodPopup button {
    margin-top: 20px;
    background: #FACC15;
    color: black;
    font-weight: bold;
    padding: 10px 18px;
    border-radius: 12px;
    transition: .2s;
}
#moodPopup button:hover { background: #e5b90f; }

@keyframes slideUp {
    from { transform: translateY(25px); opacity: 0; }
    to   { transform: translateY(0); opacity: 1; }
}
</style>


<!-- Popup -->
<div id="moodPopup">
    <div class="popup-box">
        <div id="popupEmoji" class="text-5xl mb-2"></div>
        <h3 class="text-xl font-bold mb-2">Mood Terdeteksi</h3>
        <p id="popupMessage" class="text-base opacity-90"></p>
        <button onclick="closeMoodPopup()">Oke</button>
    </div>
</div>


<!-- MAIN CONTENT -->
<div class="fade-in p-6 max-w-7xl mx-auto">

    <h2 class="text-3xl font-extrabold text-yellow-400 mb-1">👋 Gimana kabarmu hari ini?</h2>
    <p class="text-gray-500 mb-5 text-base">Take a breath. Lihat perasaanmu sebentar.</p>

    <!-- Mood Picker -->
    <div class="flex overflow-x-auto gap-4 py-4 scrollbar-hide mb-10">
        @foreach($moods as $mood)
        <button class="mood-btn flex flex-col items-center"
            style="background:{{ $mood->color }};"
            data-mood-id="{{ $mood->id }}">
            <span class="text-4xl">{{ $mood->emoji }}</span>
            <span class="text-xs font-semibold">{{ $mood->name }}</span>
        </button>
        @endforeach
    </div>

    <!-- Journal & Chart Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Journal -->
        <div class="glass p-6 shadow-xl">
            <h3 class="text-xl font-bold mb-3 text-yellow-300">📝 Catatan Hari Ini</h3>

            <form action="{{ route('store.journal') }}" method="POST">
                @csrf
                <textarea id="journalText" name="isi_jurnal" rows="3"
                    class="w-full p-3 rounded-lg text-black"
                    placeholder="Tulis apapun yang lagi kamu rasain..."></textarea>

                <button class="mt-3 bg-yellow-400 text-black px-5 py-2 rounded-lg font-semibold w-full hover:bg-yellow-300 transition">
                    Simpan Jurnal
                </button>
            </form>

            <h4 class="text-yellow-300 font-semibold mt-6 mb-2 text-sm">📌 Jurnal Terbaru</h4>
            <ul class="text-black space-y-2 max-h-48 overflow-auto scrollbar-hide">
                @forelse($journals as $j)
                <li>
                    🕓 <strong>{{ \Carbon\Carbon::parse($j->created_at)->format('d M - H:i') }}</strong><br>
                    <span>{{ \Illuminate\Support\Str::limit($j->content, 110) }}</span>
                </li>
                @empty
                <li class="italic text-black">Belum ada jurnal tersimpan.</li>
                @endforelse
            </ul>
        </div>

        <!-- Chart -->
        <div class="glass p-6 shadow-xl">
            <h3 class="text-xl font-bold mb-3 text-yellow-300">📊 Mood Statistik</h3>
            <canvas id="moodChart" height="220"></canvas>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// ==============================
// POPUP MOOD MESSAGE RANDOMIZER
// ==============================
const moodMessages = {
"🤩": [
    "Wah! Energi positifmu bersinar banget hari ini! ✨",
    "Kamu kelihatan sangat bersemangat, pertahankan ya! 🔥",
    "Hari ini kamu benar-benar unstoppable! 🤩"
],
"😄": [
    "Senang lihat kamu bahagia hari ini! 😊",
    "Semoga kebahagiaan ini nular ke banyak hal hari ini!",
    "Tetap tersenyum, itu cocok banget buat kamu 😄"
],
"😕": [
    "Kayaknya kamu lagi ragu ya? Gapapa, ambil napas dulu…",
    "Bimbang itu wajar… pelan-pelan semuanya bisa jelas kok.",
    "Kalau bingung, coba cerita di jurnal ya."
],
"😰": [
    "Kamu kelihatan cemas… kamu aman di sini.",
    "Tarik napas pelan… kamu nggak sendirian.",
    "Semoga kecemasanmu bisa sedikit lega setelah ini."
],
"😐": [
    "Hari biasa juga tetap berarti kok.",
    "Kadang flat itu normal… pelan-pelan aja.",
    "Semoga hari ini pelan-pelan jadi lebih baik."
],
"😢": [
    "Sepertinya kamu sedang sedih… pelan-pelan ya.",
    "Aku ikut merasakan beratnya. Kamu kuat kok.",
    "Kalau mau, tulis di jurnal biar sedikit lega."
],
"😭": [
    "Kamu pasti lagi berat banget ya… aku ada di sini.",
    "Menangis itu bukan lemah, itu manusiawi.",
    "Semoga ada hal kecil yang menguatkanmu hari ini."
],
"😠": [
    "Lagi marah ya? Tarik napas dulu… kamu tetap hebat.",
    "Emosi itu valid. Jangan dipendam sendirian.",
    "Semoga kemarahanmu bisa reda perlahan."
],
"😡": [
    "Kamu kelihatan benar-benar kesal… mau istirahat sebentar?",
    "Marah besar itu melelahkan. Semoga kamu dapat ketenangan.",
    "Ambil jeda… kamu pantas merasa lebih baik."
]
};


// Auto expand textarea
const t = document.getElementById('journalText');
t?.addEventListener('input', () => {
    t.style.height = "auto";
    t.style.height = t.scrollHeight + "px";
});

// Mood Save + Popup
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.mood-btn').forEach(btn => {
        btn.onclick = async () => {

            let emoji = btn.querySelector('span.text-4xl').innerText;

            btn.style.transform = "scale(1.20)";
            setTimeout(()=>btn.style.transform="scale(1)",200);

            await fetch("{{ route('store.mood') }}", {
                method:"POST",
                headers:{
                    "Content-Type":"application/json",
                    "X-CSRF-TOKEN":"{{ csrf_token() }}"
                },
                body:JSON.stringify({ mood_id: btn.dataset.moodId })
            });

            showMoodPopup(emoji);
        };
    });
});

// Show popup with emoji-based message
function showMoodPopup(emoji){
    const popup = document.getElementById("moodPopup");
    document.getElementById("popupEmoji").innerText = emoji;

    let list = moodMessages[emoji] ?? ["Terima kasih sudah jujur tentang perasaanmu hari ini."];
    let finalText = list[Math.floor(Math.random() * list.length)];

    document.getElementById("popupMessage").innerText = finalText;
    popup.style.display = "flex";
}

function closeMoodPopup(){
    document.getElementById("moodPopup").style.display="none";
    location.reload();
}


// Chart
new Chart(document.getElementById('moodChart'), {
    type:'line',
    data:{
        labels:{!! json_encode($stats->pluck('name')) !!},
        datasets:[{
            label:'Frekuensi Mood',
            data:{!! json_encode($stats->pluck('jumlah')) !!},
            borderColor:'#FACC15',
            backgroundColor:'rgba(250,204,21,0.15)',
            pointRadius:5,
            fill:true,
            tension:.35
        }]
    },
});
</script>

>>>>>>> 1394cbb (Add Laravel project files)
@endsection
