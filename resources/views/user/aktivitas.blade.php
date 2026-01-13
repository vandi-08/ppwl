@extends('user.layout')

@section('title', 'Aktivitas & Rekomendasi - YoMooD')

@section('content')
<div class="p-8 max-w-6xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-yellow-400 flex items-center gap-3">
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-gradient-to-br from-yellow-400 to-yellow-500 text-black shadow-md">
                💡
            </span>
            Aktivitas & Rekomendasi
        </h1>
        <p class="text-gray-500 mt-2 max-w-xl">
            Pilih aktivitas ringan untuk memperbaiki suasana hati — setiap aktivitas dirancang agar singkat, terarah, dan terasa memuaskan.
        </p>
    </div>

    <!-- Aktivitas grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse($activities as $act)
            <div class="relative group overflow-hidden rounded-2xl p-5 bg-gradient-to-b from-black/80 to-black/90 border border-yellow-500/10 shadow-2xl transform transition hover:-translate-y-2">
                <!-- Top row: icon + name -->
                <div class="flex items-start justify-between relative z-10">
                    <div class="flex items-start gap-4">
                        <div class="w-14 h-14 rounded-xl flex items-center justify-center text-2xl bg-yellow-50/5 text-yellow-400 shadow-inner">
                            {{ $act->icon ?? '💡' }}
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-yellow-300">{{ $act->activity_name }}</h3>
                            <div class="text-xs text-gray-400 mt-1">
                                {{ \Illuminate\Support\Str::limit($act->description ?? 'Tidak ada deskripsi', 100) }}
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-gray-400">Durasi</div>
                        <div class="font-semibold text-yellow-300">{{ $act->duration }} menit</div>
                    </div>
                </div>

                <!-- Timer -->
                <div class="mt-4 relative z-10">
                    <div id="progress-wrap-{{ $act->id }}" class="w-full bg-yellow-900/20 rounded-full h-2 overflow-hidden hidden">
                        <div id="progress-bar-{{ $act->id }}" class="h-2 rounded-full bg-gradient-to-r from-yellow-400 to-yellow-500 w-0 transition-all"></div>
                    </div>
                    <div id="timer-{{ $act->id }}" class="mt-3 text-yellow-300 font-mono text-sm hidden">
                        00:00 / {{ $act->duration }}:00
                    </div>
                </div>

                <!-- Buttons -->
                <div class="mt-5 flex items-center gap-2">
                    <button id="start-btn-{{ $act->id }}" class="flex items-center gap-2 px-3 py-2 rounded-lg bg-gradient-to-br from-yellow-400 to-yellow-500 text-black font-semibold shadow-lg hover:scale-[1.02] active:scale-95 transition" onclick="startActivity('{{ $act->id }}', {{ $act->duration }}, this)">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"><path d="M5 3v18l15-9L5 3z" fill="currentColor"/></svg>
                        <span>Mulai</span>
                    </button>
                    <button id="stop-btn-{{ $act->id }}" class="hidden items-center gap-2 px-3 py-2 rounded-lg bg-red-500 text-white font-semibold shadow-md hover:scale-[1.02] active:scale-95 transition" onclick="stopActivity('{{ $act->id }}')">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"><rect width="16" height="16" x="4" y="4" rx="2" fill="currentColor"/></svg>
                        <span>Stop</span>
                    </button>
                    <button id="pause-btn-{{ $act->id }}" class="hidden items-center gap-2 px-3 py-2 rounded-lg bg-yellow-700 text-black font-semibold shadow-md hover:scale-[1.02] active:scale-95 transition" onclick="pauseActivity('{{ $act->id }}')" title="Jeda">
                        ⏸ Jeda
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-3 p-6 bg-white rounded-lg text-center text-gray-600">Belum ada aktivitas tersedia.</div>
        @endforelse
    </div>
</div>

<script>
const timers = {};
const states = {};

function startActivity(id, duration, btnEl=null){
    if(!states[id]) states[id]={elapsed:0, duration:duration*60, running:false, paused:false};
    const state=states[id];

    // reset jika sudah selesai
    if(state.elapsed >= state.duration) state.elapsed=0;

    if(state.running && !state.paused) return;

    const timerEl=document.getElementById('timer-'+id);
    const progressWrap=document.getElementById('progress-wrap-'+id);
    const progressBar=document.getElementById('progress-bar-'+id);
    const startBtn=document.getElementById('start-btn-'+id);
    const stopBtn=document.getElementById('stop-btn-'+id);
    const pauseBtn=document.getElementById('pause-btn-'+id);

    timerEl.classList.remove('hidden');
    progressWrap.classList.remove('hidden');
    stopBtn.classList.remove('hidden');
    pauseBtn.classList.remove('hidden');
    startBtn.classList.add('opacity-60','pointer-events-none');

    state.running=true;
    state.paused=false;

    timers[id]=setInterval(()=>{
        if(state.paused) return;
        state.elapsed++;
        const mins=Math.floor(state.elapsed/60);
        const secs=state.elapsed%60;
        timerEl.textContent=String(mins).padStart(2,'0')+':'+String(secs).padStart(2,'0')+' / '+String(duration).padStart(2,'0')+':00';
        const percent=Math.min((state.elapsed/state.duration)*100,100);
        progressBar.style.width=percent+'%';
        if(state.elapsed>=state.duration) stopActivity(id);
    },1000);
}

function pauseActivity(id){
    const state=states[id]; if(!state) return;
    state.paused=!state.paused;
    const pauseBtn=document.getElementById('pause-btn-'+id);
    pauseBtn.textContent = state.paused ? 'Lanjutkan' : '⏸ Jeda';
}

function stopActivity(id){
    const state=states[id]; if(!state) return;
    clearInterval(timers[id]);
    state.running=false;
    state.elapsed=0; // reset timer

    const startBtn=document.getElementById('start-btn-'+id);
    const stopBtn=document.getElementById('stop-btn-'+id);
    const pauseBtn=document.getElementById('pause-btn-'+id);
    const timerEl=document.getElementById('timer-'+id);
    const progressBar=document.getElementById('progress-bar-'+id);

    startBtn.classList.remove('opacity-60','pointer-events-none');
    stopBtn.classList.add('hidden');
    pauseBtn.classList.add('hidden');

    timerEl.textContent='00:00 / '+String(state.duration/60).padStart(2,'0')+':00';
    progressBar.style.width='0%';
}
</script>
@endsection
