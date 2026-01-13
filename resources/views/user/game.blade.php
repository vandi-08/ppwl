@extends('user.layout')

@section('title', 'YoMooD - Game')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-3xl font-bold">Game Ringan — YoMooD</h1>
            <p class="text-gray-600 mt-1 max-w-2xl">Serangkaian mini-game psikologis singkat: felt-guided, calming, dan reflektif. Mainkan satu per satu atau coba semua untuk meningkatkan mood & insight.</p>
        </div>

        <div class="flex items-center gap-3">
            <div class="text-sm text-gray-500">Halo, <strong>{{ Auth::user()->username ?? Auth::user()->email ?? 'Pengguna' }}</strong></div>
            <button id="open-summary" class="bg-yellow-400 text-black px-3 py-1 rounded-lg font-semibold hover:bg-yellow-300">Ringkasan</button>
            <button id="open-feedback" class="text-sm px-3 py-1 rounded-lg border border-gray-200 hover:bg-gray-50">Feedback</button>
        </div>
    </div>

    <!-- Game selector -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        <button class="game-tab p-4 rounded-xl shadow-sm border border-transparent hover:shadow-lg transition text-left bg-white" data-game="color" aria-pressed="false">
            <div class="font-semibold">1. Mood Color</div>
            <div class="text-sm text-gray-500">Pilih warna yang mewakili moodmu, dapatkan insight & journaling prompt.</div>
        </button>

        <button class="game-tab p-4 rounded-xl shadow-sm border border-transparent hover:shadow-lg transition text-left bg-white" data-game="bubbles" aria-pressed="false">
            <div class="font-semibold">2. Bubble Calm</div>
            <div class="text-sm text-gray-500">Pop gelembung pelan — fokus pada nafas. Ada mode santai & timer.</div>
        </button>

        <button class="game-tab p-4 rounded-xl shadow-sm border border-transparent hover:shadow-lg transition text-left bg-white" data-game="quiz" aria-pressed="false">
            <div class="font-semibold">3. Quick Reflect</div>
            <div class="text-sm text-gray-500">5 pertanyaan reflektif singkat + insight otomatis.</div>
        </button>

        <button class="game-tab p-4 rounded-xl shadow-sm border border-transparent hover:shadow-lg transition text-left bg-white" data-game="match" aria-pressed="false">
            <div class="font-semibold">4. Pattern Match</div>
            <div class="text-sm text-gray-500">Memory game yang santai dengan tracker waktu & gerakan.</div>
        </button>

        <button class="game-tab p-4 rounded-xl shadow-sm border border-transparent hover:shadow-lg transition text-left bg-white" data-game="breathe" aria-pressed="false">
            <div class="font-semibold">5. Guided Breath</div>
            <div class="text-sm text-gray-500">Latihan napas interaktif 1 menit — visual & audio cue.</div>
        </button>
    </div>

    <!-- Controls -->
    <div class="flex items-center justify-between mb-4 gap-3">
        <div class="flex items-center gap-2">
            <button id="reset-all" class="px-3 py-1 rounded-md bg-red-50 text-red-700 border border-red-100">Reset Semua</button>
            <button id="toggle-sound" class="px-3 py-1 rounded-md bg-gray-50">Suara: On</button>
        </div>
        <div class="text-sm text-gray-500">Mood session id: <span id="session-id" class="font-mono"></span></div>
    </div>

    <!-- Game area -->
    <div id="game-area" class="bg-white rounded-2xl p-6 shadow-md min-h-[380px]"></div>

    <!-- Summary modal -->
    <div id="summary-modal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-11/12 max-w-3xl shadow-xl">
            <h3 class="text-xl font-semibold mb-3">Ringkasan Permainan</h3>
            <div id="summary-content" class="text-gray-700 text-sm max-h-72 overflow-auto"></div>
            <div class="mt-4 text-right flex justify-between items-center">
                <div class="text-xs text-gray-500">Data tersimpan lokal — hanya untuk session ini.</div>
                <div>
                    <button id="export-summary" class="px-3 py-1 rounded bg-yellow-400 mr-2">Ekspor</button>
                    <button id="close-summary" class="px-4 py-2 rounded-lg bg-gray-100">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Feedback modal -->
    <div id="feedback-modal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-11/12 max-w-lg shadow-xl">
            <h3 class="text-lg font-semibold mb-2">Berikan Feedback</h3>
            <div class="text-sm text-gray-600 mb-4">Seberapa puas kamu dengan game ini? (ini membantu meningkatkan mood flows)</div>
            <div class="flex items-center gap-3 mb-4">
                <input id="satisfaction" type="range" min="1" max="5" value="3" class="w-full" />
                <div id="sat-label" class="w-12 text-center font-semibold">3</div>
            </div>
            <textarea id="feedback-text" rows="3" class="w-full p-2 border rounded mb-4" placeholder="Catatan singkat... (opsional)"></textarea>
            <div class="flex justify-end gap-2">
                <button id="send-feedback" class="px-4 py-2 rounded bg-yellow-400">Kirim</button>
                <button id="close-feedback" class="px-4 py-2 rounded bg-gray-100">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- inline styles -->
<style>
    .bubble { border-radius: 9999px; display:flex; align-items:center; justify-content:center; cursor: pointer; box-shadow: 0 8px 20px rgba(0,0,0,0.08); user-select:none; }
    .bubble:active { transform: scale(0.95); }
    .fade-in { animation: fadeIn .35s ease both; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity:1; transform: translateY(0); } }
    .card-press:active { transform: translateY(2px) scale(0.995); }
    .confetti-piece { position:absolute; width:8px; height:12px; opacity:0.9; transform-origin:center; }
</style>

<!-- scripts -->
<script>
(function(){
    // DOM refs
    const area = document.getElementById('game-area');
    const tabs = Array.from(document.querySelectorAll('.game-tab'));
    const summaryModal = document.getElementById('summary-modal');
    const summaryContent = document.getElementById('summary-content');
    const feedbackModal = document.getElementById('feedback-modal');
    const sat = document.getElementById('satisfaction');
    const satLabel = document.getElementById('sat-label');
    const sessionEl = document.getElementById('session-id');
    const toggleSoundBtn = document.getElementById('toggle-sound');

    // state
    const state = {
        sessionId: 'sess-' + Math.random().toString(36).slice(2,9),
        played: {}, // per-game data
        meta: { sound: true, createdAt: new Date().toISOString() }
    };

    // load local
    function loadLocal(){
        try{
            const raw = localStorage.getItem('yomood_game_state_v2');
            if(raw){
                const parsed = JSON.parse(raw);
                Object.assign(state, parsed);
            } else {
                localStorage.setItem('yomood_game_state_v2', JSON.stringify(state));
            }
        } catch(e){ console.warn('Load local failed', e); }
    }
    function saveLocal(){ localStorage.setItem('yomood_game_state_v2', JSON.stringify(state)); }

    // init session display
    function initSession(){ sessionEl.innerText = state.sessionId; toggleSoundBtn.innerText = 'Suara: ' + (state.meta.sound ? 'On' : 'Off'); }

    // helpers
    function clearArea(){ area.innerHTML = ''; }
    function setTitle(t){ document.title = t + ' — YoMooD'; }
    function showToast(msg, ms = 2000){
        const t = document.createElement('div');
        t.className = 'fixed bottom-8 right-8 bg-black text-white px-4 py-2 rounded shadow-lg';
        t.innerText = msg;
        document.body.appendChild(t);
        setTimeout(()=>t.remove(), ms);
    }

    // Simple audio tick (for breath cues)
    let audioCtx = null;
    function playBeep(freq = 440, duration = 0.12){
        if(!state.meta.sound) return;
        try{
            if(!audioCtx) audioCtx = new (window.AudioContext || window.webkitAudioContext)();
            const o = audioCtx.createOscillator();
            const g = audioCtx.createGain();
            o.type = 'sine';
            o.frequency.value = freq;
            g.gain.value = 0.06;
            o.connect(g); g.connect(audioCtx.destination);
            o.start();
            setTimeout(()=>{ o.stop(); }, duration * 1000);
        } catch(e){}
    }

    // confetti (small)
    function smallConfetti(parent){
        const root = parent || document.body;
        for(let i=0;i<18;i++){
            const el = document.createElement('div');
            el.className = 'confetti-piece';
            el.style.left = (40 + Math.random()*20) + '%';
            el.style.top = (10 + Math.random()*80) + '%';
            el.style.background = ['#FFD166','#06D6A0','#118AB2','#EF476F','#8338EC'][Math.floor(Math.random()*5)];
            el.style.transform = `rotate(${Math.random()*360}deg)`;
            root.appendChild(el);
            (function(e){
                setTimeout(()=>{ e.style.transition = 'transform 1200ms linear, opacity 900ms linear, top 1200ms linear'; e.style.top = (100 + Math.random()*30) + '%'; e.style.opacity = 0; e.style.transform = `translateY(30px) rotate(${Math.random()*720}deg)`; }, 40 + Math.random()*100);
                setTimeout(()=>e.remove(), 1400);
            })(el);
        }
    }

    // ---------- GAME 1: Mood Color ----------
    function renderColorGame(){
        setTitle('Mood Color');
        clearArea();
        const palette = [
            {hex:'#FF7A7A', name:'Hangat'},
            {hex:'#FFD166', name:'Cerah'},
            {hex:'#BDE0FE', name:'Tenang'},
            {hex:'#A0E7A0', name:'Segar'},
            {hex:'#CDB4DB', name:'Melankolis'},
            {hex:'#FFB4A2', name:'Bersemangat'},
            {hex:'#9AD1D4', name:'Damai'},
            {hex:'#F4EAD5', name:'Nostalgia'},
            {hex:'#D3E2F9', name:'Fokus'},
            {hex:'#FFF1A8', name:'Ringan'}
        ];

        const wrap = document.createElement('div');
        wrap.className = 'grid grid-cols-2 md:grid-cols-5 gap-4';
        palette.forEach((p, i)=>{
            const btn = document.createElement('button');
            btn.className = 'h-28 rounded-xl shadow-md flex flex-col items-center justify-center overflow-hidden transition transform hover:scale-105 card-press';
            btn.style.background = `linear-gradient(180deg, ${p.hex} 0%, rgba(255,255,255,0.06) 100%)`;
            btn.innerHTML = `<div class="text-white/95 font-semibold drop-shadow-sm">${p.name}</div><div class="text-xs text-white/80 mt-1 opacity-90">${i+1}</div>`;
            btn.onclick = ()=>{
                const pickedAt = new Date().toISOString();
                state.played.color = { paletteIndex: i, color: p.hex, name: p.name, at: pickedAt };
                saveLocal();
                showColorResult(p);
                playBeep(520, 0.08);
            };
            wrap.appendChild(btn);
        });

        // help / journal button
        const footer = document.createElement('div');
        footer.className = 'mt-4 flex justify-between items-center';
        footer.innerHTML = `<div class="text-sm text-gray-600">Pilih satu warna yang paling mencerminkan perasaanmu sekarang.</div>
            <div class="flex gap-2">
                <button id="open-journal" class="px-3 py-1 rounded bg-yellow-400">Journal</button>
                <button id="reset-color" class="px-3 py-1 rounded bg-gray-100">Reset</button>
            </div>`;
        area.appendChild(wrap);
        area.appendChild(footer);

        document.getElementById('open-journal').onclick = ()=> openJournalModal('color');
        document.getElementById('reset-color').onclick = ()=>{
            delete state.played.color; saveLocal(); showToast('Mood color direset');
            renderColorGame();
        };
    }

    function showColorResult(p){
        clearArea();
        const container = document.createElement('div');
        container.className = 'fade-in';
        container.innerHTML = `
            <div class="mx-auto rounded-xl p-6 shadow-md max-w-2xl" style="background:linear-gradient(180deg, ${p.hex} 0%, rgba(255,255,255,0.03) 100%);">
                <div class="text-2xl font-bold text-white mb-2">${p.name}</div>
                <div class="text-white/90 mb-4">Warna yang kamu pilih dapat memberi petunjuk — ingat, ini bukan diagnosis. Coba jawab satu prompt singkat untuk lebih memahami rasa itu.</div>
                <div class="flex gap-2 justify-center">
                    <button id="save-mood-btn" class="px-4 py-2 rounded-lg bg-white text-black font-semibold">Simpan & Catat</button>
                    <button id="back-color" class="px-4 py-2 rounded-lg bg-white/20 text-white">Kembali</button>
                </div>
            </div>
        `;
        area.appendChild(container);

        document.getElementById('back-color').onclick = renderColorGame;
        document.getElementById('save-mood-btn').onclick = ()=>{
            openJournalModal('color');
        };
    }

    // Journal modal (simple inline)
    function openJournalModal(forGame){
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-60';
        modal.innerHTML = `
            <div class="bg-white rounded-xl p-4 w-11/12 max-w-lg shadow-xl">
                <h4 class="font-semibold mb-2">Journal singkat — ${forGame}</h4>
                <p class="text-xs text-gray-500 mb-2">Tulis satu kalimat tentang mengapa warna ini cocok untukmu.</p>
                <textarea id="journal-input" rows="4" class="w-full p-2 border rounded mb-3"></textarea>
                <div class="flex justify-end gap-2">
                    <button id="save-journal" class="px-3 py-1 rounded bg-yellow-400">Simpan</button>
                    <button id="cancel-journal" class="px-3 py-1 rounded bg-gray-100">Batal</button>
                </div>
            </div>`;
        document.body.appendChild(modal);

        modal.querySelector('#cancel-journal').onclick = ()=> modal.remove();
        modal.querySelector('#save-journal').onclick = ()=>{
            const v = modal.querySelector('#journal-input').value.trim();
            state.played.journal = state.played.journal || [];
            state.played.journal.push({ game: forGame, text: v || '(kosong)', at: new Date().toISOString() });
            saveLocal();
            showToast('Journal tersimpan.');
            modal.remove();
        };
    }

    // ---------- GAME 2: Bubble Calm ----------
    function renderBubbles(){
        setTitle('Bubble Calm');
        clearArea();
        const wrap = document.createElement('div');
        wrap.className = 'relative h-80 bg-gradient-to-b from-white to-yellow-50 rounded-xl p-6 overflow-hidden';

        // create container for bubble controls
        const controls = document.createElement('div');
        controls.className = 'mt-4 flex items-center justify-between';
        controls.innerHTML = `<div class="text-sm text-gray-600">Ketuk gelembung pelan — napas keluar saat pop.</div>
            <div class="flex gap-2">
                <button id="reset-bubbles" class="px-3 py-1 rounded bg-yellow-400">Reset</button>
                <button id="toggle-bubble-timer" class="px-3 py-1 rounded bg-gray-100">Timer: Off</button>
            </div>`;
        area.appendChild(wrap);
        area.appendChild(controls);

        // populate bubbles with animation (gentle float)
        const bubblesArea = wrap;
        const existingCount = state.played.bubblesCount || 12;
        createBubbleSet(existingCount);

        // timer toggle
        let bubbleTimer = null;
        document.getElementById('toggle-bubble-timer').onclick = function(){
            const el = this;
            if(bubbleTimer){
                clearInterval(bubbleTimer); bubbleTimer = null; el.innerText = 'Timer: Off';
            } else {
                bubbleTimer = setInterval(()=>{ state.played.bubblesTimerPings = (state.played.bubblesTimerPings||0)+1; saveLocal(); playBeep(440,0.06); }, 8000);
                el.innerText = 'Timer: On';
            }
        };

        document.getElementById('reset-bubbles').onclick = ()=>{
            state.played.bubbles = 0;
            saveLocal();
            showToast('Bubble direset');
            renderBubbles();
        };

        function createBubbleSet(count){
            bubblesArea.innerHTML = '';
            for(let i=0;i<count;i++){
                const b = document.createElement('div');
                const size = 40 + Math.floor(Math.random()*70);
                b.className = 'bubble absolute fade-in';
                b.style.width = b.style.height = size + 'px';
                b.style.left = (Math.random()*80) + '%';
                b.style.top = (Math.random()*70) + '%';
                b.style.background = `hsla(${Math.random()*360},60%,70%,0.95)`;
                b.style.opacity = 0.95;
                b.style.transition = 'transform 0.45s, opacity 0.45s';
                // gentle float animation using CSS transform keyframes programmatically
                const floatDur = 6 + Math.random()*6;
                b.animate([{transform:'translateY(0px)'},{transform:`translateY(${10 + Math.random()*20}px)`},{transform:'translateY(0px)'}], {duration: floatDur*1000, iterations: Infinity, easing: 'ease-in-out'});
                b.onclick = ()=>{
                    // pop animation
                    b.style.transform = 'scale(0)';
                    b.style.opacity = 0;
                    setTimeout(()=>b.remove(),400);
                    state.played.bubbles = (state.played.bubbles||0) + 1;
                    state.played.bubblesLast = new Date().toISOString();
                    saveLocal();
                    playBeep(660, 0.06);
                };
                bubblesArea.appendChild(b);
            }
            // counter shown
            const counter = document.createElement('div');
            counter.className = 'absolute bottom-3 right-3 bg-white/80 px-3 py-1 rounded-full text-sm';
            counter.innerText = `Pops: ${state.played.bubbles || 0}`;
            bubblesArea.appendChild(counter);
            // update counter live
            const cInt = setInterval(()=>{ counter.innerText = `Pops: ${state.played.bubbles || 0}`; }, 500);
            // cleanup when leaving area
            area.dataset.cleanup = (area.dataset.cleanup || '') + cInt + ',';
        }
    }

    // ---------- GAME 3: Quick Reflect ----------
    const reflectQs = [
        {q: 'Apa yang membuatmu paling bersyukur hari ini?', type:'text', hint: 'Sebutkan singkat satu hal.'},
        {q: 'Pilih satu kata yang paling cocok sekarang', type:'choice', options:['Tenang','Sibuk','Lelah','Semangat','Cemas']},
        {q: 'Skala energi saat ini (1-5)', type:'scale', scale:5},
        {q: 'Satu tindakan kecil yang bisa memperbaiki moodmu?', type:'text', hint:'Contoh: minum air, jalan 5 menit.'},
        {q: 'Apa yang ingin kamu ingat nanti malam?', type:'text', hint:'Satu kalimat singkat.'}
    ];

    function renderReflect(){
        setTitle('Quick Reflect');
        clearArea();
        const form = document.createElement('div');
        form.className = 'space-y-4';

        reflectQs.forEach((item, idx)=>{
            const box = document.createElement('div');
            box.className = 'p-4 rounded-lg border';
            let inner = `<div class="font-semibold mb-2">${idx+1}. ${item.q}</div>`;
            if(item.hint) inner += `<div class="text-xs text-gray-400 mb-2">${item.hint}</div>`;
            if(item.type === 'text'){
                inner += `<textarea data-q="${idx}" class="w-full p-2 border rounded" rows="2"></textarea>`;
            } else if(item.type === 'choice'){
                const opts = item.options.map(o=>`<button data-q="${idx}" data-choice="${o}" class="mr-2 mb-2 px-3 py-1 rounded bg-gray-100">${o}</button>`).join('');
                inner += `<div>${opts}</div>`;
            } else if(item.type === 'scale'){
                const s = Array.from({length:item.scale},(_,i)=>`<button data-q="${idx}" data-choice="${i+1}" class="mr-2 mb-2 px-3 py-1 rounded bg-gray-100">${i+1}</button>`).join('');
                inner += `<div>${s}</div>`;
            }
            box.innerHTML = inner;
            form.appendChild(box);
        });

        const submit = document.createElement('div');
        submit.className = 'text-right';
        submit.innerHTML = `<button id="submit-reflect" class="px-4 py-2 rounded-lg bg-yellow-400 font-semibold">Selesai & Lihat Insight</button>`;
        form.appendChild(submit);
        area.appendChild(form);

        // handlers
        area.querySelectorAll('button[data-q]').forEach(b=>{
            b.addEventListener('click', (e)=>{
                const q = b.getAttribute('data-q');
                const choice = b.getAttribute('data-choice');
                state.played.reflect = state.played.reflect || {};
                state.played.reflect[q] = choice;
                // visual feedback
                const siblings = b.parentNode.querySelectorAll('button[data-q="'+q+'"]');
                siblings.forEach(s=>s.classList.remove('bg-yellow-200'));
                b.classList.add('bg-yellow-200');
                saveLocal();
            });
        });

        document.querySelectorAll('textarea[data-q]').forEach(t=>{
            t.addEventListener('input', ()=>{
                const q = t.getAttribute('data-q');
                state.played.reflect = state.played.reflect || {};
                state.played.reflect[q] = t.value;
                saveLocal();
            });
        });

        document.getElementById('submit-reflect').onclick = ()=>{
            const r = state.played.reflect || {};
            let lines = [];
            for(let i=0;i<reflectQs.length;i++){
                const v = r[i] || '(tidak diisi)';
                lines.push(`${i+1}. ${reflectQs[i].q} → ${v}`);
            }
            state.played.reflectSummary = lines;
            state.played.reflectAt = new Date().toISOString();
            saveLocal();
            // produce a tiny AI-like insight (simple rule-based)
            const energy = r[2] ? parseInt(r[2]) : null;
            const insight = [];
            if(energy !== null){
                if(energy >= 4) insight.push('Energimu tinggi — manfaatkan untuk tugas yang menantang.');
                else if(energy >= 2) insight.push('Energi sedang — fokus pada tugas kecil & self-care.');
                else insight.push('Energi rendah — beri dirimu jeda dan lakukan sesuatu sederhana.');
            }
            if(r[0]) insight.push('Rasa syukur bagus — pertahankan dengan mencatat hal kecil ini secara rutin.');
            showModalSummary('Insight singkat', lines.join('<br>') + '<hr>' + insight.join('<br>'));
            playBeep(720,0.08);
        };
    }

    // ---------- GAME 4: Pattern Match ----------
    function renderPattern(){
        setTitle('Pattern Match');
        clearArea();

        // difficulty choices & controls
        const controls = document.createElement('div');
        controls.className = 'flex items-center justify-between mb-4';
        controls.innerHTML = `<div class="text-sm text-gray-600">Memory match — cocok untuk mengalihkan pikiran & melatih fokus.</div>
            <div class="flex items-center gap-2">
                <label class="text-xs text-gray-500 mr-2">Ukuran</label>
                <select id="match-size" class="px-2 py-1 rounded border bg-white">
                    <option value="8">4x2 (Mudah)</option>
                    <option value="12" selected>4x3 (Normal)</option>
                    <option value="16">4x4 (Sulit)</option>
                </select>
                <button id="restart-match" class="px-3 py-1 rounded bg-yellow-400">Mulai</button>
            </div>`;
        area.appendChild(controls);

        const gridWrap = document.createElement('div');
        gridWrap.className = 'grid gap-4';
        area.appendChild(gridWrap);

        // initial render
        function startMatch(size = 12){
            gridWrap.innerHTML = '';
            const symbols = ['★','❤','☀','☂','♫','⚡','✿','◆','♞','☯','✪','✦','✈','✶','❖','✺'];
            let deck = symbols.slice(0, size/2).concat(symbols.slice(0, size/2));
            // shuffle
            for(let i=deck.length-1;i>0;i--){ const j = Math.floor(Math.random()*(i+1)); [deck[i],deck[j]]=[deck[j],deck[i]]; }
            // layout cols
            const cols = (size <= 8) ? 4 : (size <= 12) ? 4 : 4;
            gridWrap.className = `grid grid-cols-2 md:grid-cols-${cols} gap-4`;
            const stateMatch = {open:[], matched:[], moves:0, startAt: Date.now()};

            deck.forEach((sym, idx)=>{
                const card = document.createElement('button');
                card.className = 'h-24 rounded-lg bg-gray-50 flex items-center justify-center text-2xl font-bold card-press';
                card.dataset.index = idx;
                card.innerHTML = `<span class="hidden">${sym}</span>`;
                card.onclick = ()=>{
                    if(stateMatch.matched.includes(idx) || stateMatch.open.includes(idx)) return;
                    stateMatch.open.push(idx);
                    reveal();
                };
                gridWrap.appendChild(card);
            });

            function reveal(){
                Array.from(gridWrap.children).forEach((c, idx)=>{
                    const inner = c.querySelector('span').textContent;
                    if(stateMatch.open.includes(idx) || stateMatch.matched.includes(idx)){
                        c.innerHTML = inner;
                        c.classList.add('bg-yellow-50');
                    } else c.innerHTML = '';
                });

                if(stateMatch.open.length === 2){
                    stateMatch.moves++;
                    const [a,b] = stateMatch.open;
                    const sa = gridWrap.children[a].querySelector('span').textContent;
                    const sb = gridWrap.children[b].querySelector('span').textContent;
                    if(sa === sb){
                        stateMatch.matched.push(a,b);
                        state.played.match = state.played.match || [];
                        state.played.match.push({ size: deck.length, at: new Date().toISOString(), moves: stateMatch.moves, durationSec: Math.round((Date.now() - stateMatch.startAt)/1000) });
                        saveLocal();
                        playBeep(880,0.06);
                    } else {
                        playBeep(320,0.05);
                    }
                    setTimeout(()=>{ stateMatch.open = []; reveal(); }, 700);
                }

                if(stateMatch.matched.length === deck.length){
                    const duration = Math.round((Date.now() - stateMatch.startAt)/1000);
                    showModalSummary('Selamat!', [`Kamu menyelesaikan pattern match — moves: ${stateMatch.moves}, waktu: ${duration}s`]);
                    smallConfetti(area);
                    saveLocal();
                }
            }
        }

        // attach controls
        document.getElementById('restart-match').onclick = ()=>{
            const s = parseInt(document.getElementById('match-size').value,10);
            startMatch(s);
        };

        // auto start default
        startMatch(parseInt(document.getElementById('match-size').value,10));
    }

    // ---------- GAME 5: Guided Breath ----------
    function renderBreath(){
        setTitle('Guided Breath');
        clearArea();
        const box = document.createElement('div');
        box.className = 'flex flex-col items-center gap-4';
        box.innerHTML = `
            <canvas id="breath-canvas" width="320" height="320" class="rounded-full shadow-inner bg-yellow-50"></canvas>
            <div class="text-gray-600 max-w-xl text-center">Ikuti lingkaran — tarik nafas saat membesar, hembus saat mengecil. Pilih durasi & mode.</div>
            <div class="flex gap-2 mt-2">
                <select id="breath-mode" class="px-3 py-1 rounded border bg-white">
                    <option value="simple">Simple (4-2-6)</option>
                    <option value="relax">Relax (4-4-8)</option>
                    <option value="quick">Quick (3-2-4)</option>
                </select>
                <select id="breath-duration" class="px-3 py-1 rounded border bg-white">
                    <option value="30">30s</option>
                    <option value="60" selected>60s</option>
                    <option value="120">120s</option>
                </select>
                <button id="start-breath" class="px-4 py-2 rounded bg-yellow-400">Mulai</button>
                <button id="stop-breath" class="px-4 py-2 rounded bg-gray-100">Stop</button>
            </div>
        `;
        area.appendChild(box);

        const canvas = document.getElementById('breath-canvas');
        const ctx = canvas.getContext('2d');
        let anim = null;
        let startTime = null;
        let durationTotal = 60;
        let sequence = [4,2,6]; // in/out/hold pattern seconds

        function drawRing(progress, phaseText){
            const w = canvas.width, h = canvas.height;
            ctx.clearRect(0,0,w,h);
            // background ring
            const cx = w/2, cy = h/2;
            const maxR = Math.min(w,h)/2 - 16;
            const r = 40 + (maxR-40) * progress;
            // soft shadow
            ctx.beginPath();
            ctx.fillStyle = '#fff9e6';
            ctx.arc(cx, cy, r+8, 0, Math.PI*2);
            ctx.fill();

            // gradient
            const g = ctx.createRadialGradient(cx, cy, r*0.2, cx, cy, r);
            g.addColorStop(0, '#fffbe6');
            g.addColorStop(1, '#fff1a8');
            ctx.beginPath();
            ctx.fillStyle = g;
            ctx.arc(cx, cy, r, 0, Math.PI*2);
            ctx.fill();

            // center text
            ctx.fillStyle = '#333';
            ctx.font = '28px sans-serif';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillText(phaseText, cx, cy);
        }

        // build breathing timeline array of steps (for one cycle) based on mode
        function modeToSeq(mode){
            if(mode === 'relax') return [4,4,8];
            if(mode === 'quick') return [3,2,4];
            return [4,2,6];
        }

        let cycleStart = 0;
        let elapsedGlobal = 0;

        document.getElementById('start-breath').onclick = ()=>{
            if(anim) return;
            const mode = document.getElementById('breath-mode').value;
            const durChoice = parseInt(document.getElementById('breath-duration').value,10);
            sequence = modeToSeq(mode);
            durationTotal = durChoice;
            startTime = performance.now();
            elapsedGlobal = 0;
            cycleStart = startTime;
            let cycleLen = sequence.reduce((a,b)=>a+b,0);
            // draw initial
            function frame(now){
                const t = now - startTime;
                const tSec = Math.floor(t/1000);
                elapsedGlobal = tSec;
                if(tSec >= durationTotal){
                    cancelAnimationFrame(anim);
                    anim = null;
                    showModalSummary('Selesai', ['Latihan pernapasan selesai. Tarik nafas dalam, rubah pelan-pelan.']);
                    playBeep(880,0.12);
                    return;
                }
                // cycle position
                const cycleElapsed = ((now - cycleStart)/1000) % cycleLen;
                // determine phase (in, hold, out)
                let acc = 0; let phaseIndex = 0;
                for(let i=0;i<sequence.length;i++){
                    acc += sequence[i];
                    if(cycleElapsed <= acc){ phaseIndex = i; break; }
                }
                let phaseProgress; // 0..1 progress inside phase
                let prevAcc = acc - sequence[phaseIndex];
                phaseProgress = ((cycleElapsed - prevAcc) / sequence[phaseIndex]);
                // map to visual scale (inhale -> expand, hold -> big, exhale -> shrink)
                let progressVisual = 0;
                let phaseLabel = '';
                if(phaseIndex === 0){ // inhale
                    progressVisual = phaseProgress;
                    phaseLabel = 'Tarik — ' + Math.ceil((sequence[0] - (phaseProgress*sequence[0])) ) + 's';
                    if(phaseProgress < 0.12) playBeep(880,0.05);
                } else if(phaseIndex === 1){ // hold
                    progressVisual = 1;
                    phaseLabel = 'Tahan';
                } else { // exhale
                    progressVisual = 1 - phaseProgress;
                    phaseLabel = 'Hembus — ' + Math.ceil((sequence[2] - (phaseProgress*sequence[2])) ) + 's';
                    if(phaseProgress < 0.12) playBeep(440,0.05);
                }
                drawRing(0.3 + progressVisual * 0.7, phaseLabel + `  (${durationTotal - tSec}s)`);
                anim = requestAnimationFrame(frame);
            }
            anim = requestAnimationFrame(frame);
        };
        document.getElementById('stop-breath').onclick = ()=>{
            if(anim){ cancelAnimationFrame(anim); anim = null; showToast('Latihan dihentikan'); playBeep(220,0.06); }
        };

        // initial draw
        drawRing(0.4, 'Siap?');
    }

    // ---------- UI: tabs & attach ----------
    function attachTabHandlers(){
        tabs.forEach(t=>{
            t.addEventListener('click', ()=>{
                tabs.forEach(x=>x.classList.remove('ring-2','ring-yellow-300','bg-yellow-50'));
                t.classList.add('ring-2','ring-yellow-300');
                const g = t.getAttribute('data-game');
                if(g==='color') renderColorGame();
                if(g==='bubbles') renderBubbles();
                if(g==='quiz') renderReflect();
                if(g==='match') renderPattern();
                if(g==='breathe') renderBreath();
            });
            t.addEventListener('keydown', (e)=>{ if(e.key === 'Enter' || e.key === ' ') t.click(); });
        });
    }

    // ---------- Summary modal ----------
    function showModalSummary(title, html){
        summaryContent.innerHTML = `<strong class="block mb-2">${title}</strong><div class="text-sm">${html}</div>`;
        summaryModal.classList.remove('hidden'); summaryModal.classList.add('flex');
    }

    document.getElementById('open-summary').onclick = ()=>{
        const s = state.played || {};
        const parts = [];
        if(s.color) parts.push(`<div><strong>Warna:</strong> ${s.color.name} <span class="text-xs text-gray-400">(${s.color.color})</span></div>`);
        if(s.bubbles) parts.push(`<div><strong>Bubble pops:</strong> ${s.bubbles}</div>`);
        if(s.reflectSummary) parts.push(`<div><strong>Reflection:</strong><div class='mt-1 text-xs'>${s.reflectSummary.join('<br>')}</div></div>`);
        if(s.match) {
            const list = (s.match||[]).map(m=>`<div class="text-xs">• ${m.size} cards — moves ${m.moves} — ${m.durationSec}s (${m.at})</div>`).join('');
            parts.push(`<div><strong>Match history:</strong>${list}</div>`);
        }
        if(s.journal) parts.push(`<div><strong>Journal:</strong><div class='mt-1 text-xs'>${s.journal.map(j=>`${j.at}: ${j.text}`).join('<br>')}</div></div>`);
        if(parts.length===0) parts.push('<div class="text-gray-500">Belum ada aktivitas tercatat. Coba mainkan salah satu game!</div>');
        showModalSummary('Ringkasan', parts.join(''));
    };
    document.getElementById('close-summary').onclick = ()=>{ summaryModal.classList.add('hidden'); summaryModal.classList.remove('flex'); };

    // export summary (download JSON)
    document.getElementById('export-summary').onclick = ()=>{
        const data = JSON.stringify(state, null, 2);
        const blob = new Blob([data], {type:'application/json'});
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url; a.download = `yomood_summary_${state.sessionId}.json`;
        document.body.appendChild(a); a.click(); a.remove(); URL.revokeObjectURL(url);
    };

    // ---------- Feedback modal ----------
    document.getElementById('open-feedback').onclick = ()=>{ feedbackModal.classList.remove('hidden'); feedbackModal.classList.add('flex'); };
    document.getElementById('close-feedback').onclick = ()=>{ feedbackModal.classList.add('hidden'); feedbackModal.classList.remove('flex'); };
    sat.oninput = ()=> satLabel.innerText = sat.value;
    document.getElementById('send-feedback').onclick = ()=>{
        const val = sat.value;
        const text = document.getElementById('feedback-text').value.trim();
        state.meta.feedback = state.meta.feedback || [];
        state.meta.feedback.push({score: val, text: text || '', at: new Date().toISOString()});
        saveLocal();
        showToast('Terima kasih atas feedback-mu!');
        feedbackModal.classList.add('hidden'); feedbackModal.classList.remove('flex');
    };

    // reset all
    document.getElementById('reset-all').onclick = ()=>{
        if(confirm('Reset semua data permainan lokal?')) {
            localStorage.removeItem('yomood_game_state_v2');
            Object.keys(state).forEach(k=>delete state[k]);
            state.sessionId = 'sess-' + Math.random().toString(36).slice(2,9);
            state.played = {}; state.meta = { sound: state.meta.sound };
            saveLocal(); initSession(); showToast('Semua data direset');
            // reload first tab
            tabs[0].click();
        }
    };

    // sound toggle
    toggleSoundBtn.onclick = ()=>{
        state.meta.sound = !state.meta.sound;
        toggleSoundBtn.innerText = 'Suara: ' + (state.meta.sound ? 'On' : 'Off');
        saveLocal();
    };

    // allow closing modals by click outside
    summaryModal.addEventListener('click', (e)=>{ if(e.target === summaryModal){ summaryModal.classList.add('hidden'); summaryModal.classList.remove('flex'); } });
    feedbackModal.addEventListener('click', (e)=>{ if(e.target === feedbackModal){ feedbackModal.classList.add('hidden'); feedbackModal.classList.remove('flex'); } });

    // cleanup timers on unload (clear intervals stored in dataset)
    window.addEventListener('beforeunload', ()=> {
        const list = (area.dataset.cleanup || '').split(',').filter(Boolean);
        list.forEach(id => { try{ clearInterval(parseInt(id)); }catch(e){} });
    });

    // init
    loadLocal(); initSession(); attachTabHandlers();
    // open first game by default
    tabs[0].click();
})();
</script>
@endsection
