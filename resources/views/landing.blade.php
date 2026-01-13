<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>YoMooD - Jurnal Harian</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-in {
            animation: fadeIn 2s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Animasi scroll emoji */
        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .animate-scroll {
            display: inline-flex;
            white-space: nowrap;
            animation: scroll 18s linear infinite;
        }

        .emoji {
            display: inline-block;
            margin: 0 20px;
            font-size: 3rem;
            transition: transform 0.3s ease, filter 0.3s;
            cursor: pointer;
        }

        /* Saat disentuh */
        .emoji:hover {
            transform: scale(2);
            filter: drop-shadow(0 0 10px gold);
        }

        @keyframes float {
            0% { transform: translateY(0); }
            100% { transform: translateY(-10px); }
        }

        /* Efek percikan */
        .spark {
            position: absolute;
            width: 15px;
            height: 15px;
            background: gold;
            border-radius: 50%;
            opacity: 0;
            animation: spark 0.8s ease-out forwards;
            pointer-events: none;
        }
        @keyframes spark {
            0% { transform: translate(0, 0) scale(1); opacity: 1; }
            100% { transform: translate(var(--x), var(--y)) scale(0); opacity: 0; }
        }
    </style>
</head>
<body class="bg-yellow-50 text-gray-900 flex flex-col min-h-screen relative">

    <!-- Navbar -->
    <div class="flex justify-between items-center bg-black text-yellow-400 px-8 py-4 shadow-lg">
        <div class="flex items-center gap-2">
            <a href="/">
                <img id="logo" src="{{ asset('images/logo.png') }}" alt="YoMooD Logo" class="w-8 h-8 hover:scale-110 transition cursor-pointer">
            </a>
            <a href="/" class="text-xl font-bold hover:text-white transition">YoMooD</a>
        </div>
        <div class="space-x-6">
            <a href="/blog" class="text-yellow-400 hover:text-white font-semibold">Blog</a>
            <a href="/login" class="bg-yellow-400 text-black px-3 py-1 rounded hover:bg-yellow-300 transition">Login</a>
        </div>
    </div>

    <!-- Main content -->
    <div class="flex flex-col items-center justify-center flex-1 text-center fade-in">
        <img 
            id="logoMain"
            src="{{ asset('images/logo.png') }}" 
            alt="YoMooD Logo" 
            class="w-56 h-56 mb-8 shadow-2xl rounded-full hover:scale-110 transition-transform duration-300"
        >

        <h2 class="text-3xl font-bold mb-3 text-black">YoMooD - Ketahui Moodmu</h2>
        <p class="text-gray-700 max-w-xl leading-relaxed">
            <b>Jurnal Perawatan Diri dengan Tujuan</b><br>
            Buku Harian Suasana Hati & Pelacak Kebahagiaan.<br>
            Buat buku harian dan abadikan harimu tanpa menulis sepatah kata pun!
        </p>

        <!-- Teks motivasi -->
        <p class="mt-6 text-yellow-600 font-medium italic max-w-lg text-center leading-relaxed">
            🌟 Coba mood tracker sekarang <br>
            Pilih mood yang mencerminkan perasaanmu hari ini.<br>
            Mood bukan hanya cerminan hari ini, tapi penentu warna harimu esok.<br>
            Jadikan setiap emosi bagian dari perjalananmu 💛
        </p>

        <!-- Emoji berjalan -->
        <div class="overflow-hidden w-full mt-8">
            <div class="animate-scroll">
                <span class="emoji" data-target="bahagia">🤩</span>
                <span class="emoji" data-target="senang">😄</span>
                <span class="emoji" data-target="bimbang">😕</span>
                <span class="emoji" data-target="cemas">😰</span>
                <span class="emoji" data-target="biasa-saja">😐</span>
                <span class="emoji" data-target="sedih">😢</span>
                <span class="emoji" data-target="sangat-sedih">😭</span>
                <span class="emoji" data-target="marah">😠</span>
                <span class="emoji" data-target="sangat-marah">😡</span>

                <!-- Duplikasi agar scroll looping -->
                <span class="emoji" data-target="bahagia">🤩</span>
                <span class="emoji" data-target="senang">😄</span>
                <span class="emoji" data-target="bimbang">😕</span>
                <span class="emoji" data-target="cemas">😰</span>
                <span class="emoji" data-target="biasa-saja">😐</span>
                <span class="emoji" data-target="sedih">😢</span>
                <span class="emoji" data-target="sangat-sedih">😭</span>
                <span class="emoji" data-target="marah">😠</span>
                <span class="emoji" data-target="sangat-marah">😡</span>

                <span class="emoji" data-target="bahagia">🤩</span>
                <span class="emoji" data-target="senang">😄</span>
                <span class="emoji" data-target="bimbang">😕</span>
                <span class="emoji" data-target="cemas">😰</span>
                <span class="emoji" data-target="biasa-saja">😐</span>
                <span class="emoji" data-target="sedih">😢</span>
                <span class="emoji" data-target="sangat-sedih">😭</span>
                <span class="emoji" data-target="marah">😠</span>
                <span class="emoji" data-target="sangat-marah">😡</span>

                <span class="emoji" data-target="bahagia">🤩</span>
                <span class="emoji" data-target="senang">😄</span>
                <span class="emoji" data-target="bimbang">😕</span>
                <span class="emoji" data-target="cemas">😰</span>
                <span class="emoji" data-target="biasa-saja">😐</span>
                <span class="emoji" data-target="sedih">😢</span>
                <span class="emoji" data-target="sangat-sedih">😭</span>
                <span class="emoji" data-target="marah">😠</span>
                <span class="emoji" data-target="sangat-marah">😡</span>
            </div>
        </div>
    </div>


   <!-- Kontainer Promosi Horizontal -->
<div class="py-8 flex justify-center">
    <div id="promoBoxContainer" class="flex gap-6 overflow-x-auto no-scrollbar select-none">
        
        <!-- Contoh Fitur 1: Mood Tracker -->
        <div class="w-[220px] min-w-[220px] bg-black rounded-xl shadow-xl flex flex-col items-center text-center p-4">
            <img src="{{ asset('images/promosi/mood_tracker.png') }}" alt="Mood Tracker" class="w-36 h-36 object-contain mb-4 rounded-lg">
            <h4 class="font-extrabold text-2xl text-yellow-400 mb-2">Mood Tracker</h4>
            <p class="text-gray-200 text-base leading-relaxed">
                Pantau suasana hatimu setiap hari dan lihat tren mood untuk memahami dirimu lebih baik.
            </p>
        </div>

        <!-- Contoh Fitur 2: Jurnal -->
        <div class="w-[220px] min-w-[220px] bg-black rounded-xl shadow-xl flex flex-col items-center text-center p-4">
            <img src="{{ asset('images/promosi/jurnal.png') }}" alt="Jurnal" class="w-36 h-36 object-contain mb-4 rounded-lg">
            <h4 class="font-extrabold text-2xl text-yellow-400 mb-2">Jurnal</h4>
            <p class="text-gray-200 text-base leading-relaxed">
                Abadikan momen dan refleksi harianmu, temukan pola emosimu dari catatan harian.
            </p>
        </div>

        <!-- Contoh Fitur 3: Aktivitas -->
        <div class="w-[220px] min-w-[220px] bg-black rounded-xl shadow-xl flex flex-col items-center text-center p-4">
            <img src="{{ asset('images/promosi/aktivitas.png') }}" alt="Aktivitas" class="w-36 h-36 object-contain mb-4 rounded-lg">
            <h4 class="font-extrabold text-2xl text-yellow-400 mb-2">Aktivitas</h4>
            <p class="text-gray-200 text-base leading-relaxed">
                Temukan aktivitas sesuai mood untuk perbaiki suasana hati dan jadikan harimu lebih positif.
            </p>
        </div>

        <!-- Contoh Fitur 4: Statistik Mood -->
        <div class="w-[220px] min-w-[220px] bg-black rounded-xl shadow-xl flex flex-col items-center text-center p-4">
            <img src="{{ asset('images/promosi/statistik.png') }}" alt="Statistik Mood" class="w-36 h-36 object-contain mb-4 rounded-lg">
            <h4 class="font-extrabold text-2xl text-yellow-400 mb-2">Statistik Mood</h4>
            <p class="text-gray-200 text-base leading-relaxed">
                Pantau tren mood dan insight dari catatanmu untuk perbaikan diri yang berkelanjutan.
            </p>
        </div>

        <!-- Contoh Fitur 5: Game Ringan -->
        <div class="w-[220px] min-w-[220px] bg-black rounded-xl shadow-xl flex flex-col items-center text-center p-4">
            <img src="{{ asset('images/promosi/game.png') }}" alt="Statistik Mood" class="w-36 h-36 object-contain mb-4 rounded-lg">
            <h4 class="font-extrabold text-2xl text-yellow-400 mb-2">Game Ringan</h4>
            <p class="text-gray-200 text-base leading-relaxed">
                Mainkan game yang bisa membantu suasana hati menjadi lebih relax dan tenang.
            </p>
        </div>

    </div>
</div>

<style>
    /* Hilangkan scroll bar */
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

    /* Hilangkan efek seleksi teks */
    .select-none { user-select: none; -webkit-user-select: none; -ms-user-select: none; }

    /* Drag horizontal */
    #promoBoxContainer { cursor: grab; }
    #promoBoxContainer:active { cursor: grabbing; }
</style>

<script>
    const slider = document.getElementById('promoBoxContainer');
    let isDown = false, startX, scrollLeft;

    slider.addEventListener('mousedown', e => {
        isDown = true;
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });
    slider.addEventListener('mouseleave', () => isDown = false);
    slider.addEventListener('mouseup', () => isDown = false);
    slider.addEventListener('mousemove', e => {
        if(!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 2; // scroll speed
        slider.scrollLeft = scrollLeft - walk;
    });
</script>


    <!-- Section Penutup Compact -->
<div class="bg-yellow-50 min-h-[300px] flex flex-col items-center justify-center text-center px-6">
    <!-- Judul -->
    <h2 class="text-3xl font-extrabold text-yellow mb-4 drop-shadow-md">
        Kenali Moodmu, Hidup Lebih Terarah
    </h2>

    <!-- Deskripsi -->
    <p class="text-gray-700 text-base md:text-lg max-w-xl mb-6 leading-relaxed">
        YoMooD membantu kamu memahami emosi, merefleksikan hari, dan menemukan cara untuk tetap positif.  
        Catat mood harianmu, lihat pola emosimu, dan buat perjalanan pribadimu lebih bermakna.
    </p>

    <!-- Tombol Join Kecil -->
    <a href="{{ route('login') }}" class="bg-black text-yellow-400 font-bold px-5 py-2 rounded-lg shadow-md hover:bg-yellow-400 hover:text-black transition-all duration-300">
        Join Sekarang
    </a>
</div>


         <!-- Mood Tracker -->
  <div class="bg-yellow-50 py-6 text-center">
    <h3 class="text-lg font-semibold mb-4">Bagaimana perasaanmu hari ini?</h3>
    <div class="flex justify-center gap-6 flex-wrap">
      <span class="emoji" onclick="showQuote('quote1')">🤩</span>
      <span class="emoji" onclick="showQuote('quote2')">😄</span>
      <span class="emoji" onclick="showQuote('quote3')">😕</span>
      <span class="emoji" onclick="showQuote('quote4')">😰</span>
      <span class="emoji" onclick="showQuote('quote5')">😐</span>
      <span class="emoji" onclick="showQuote('quote6')">😢</span>
      <span class="emoji" onclick="showQuote('quote7')">😭</span>
      <span class="emoji" onclick="showQuote('quote8')">😠</span>
      <span class="emoji" onclick="showQuote('quote9')">😡</span>
    </div>





  </div>
 <!-- Bagian Deskripsi Emoji -->
    <div id="deskripsi" class="bg-yellow-50 mt-10 py-12 text-center">
        <h3 class="text-2xl font-bold mb-8 text-gray-800">Makna di Balik Moods?</h3>



  <!-- Quotes Section -->
  <div id="quote1" class="quote-section max-w-2xl mx-auto mt-12 text-center p-6">
    <h4 class="text-2xl mb-2 font-semibold text-yellow-600">🤩 Sangat Bahagia</h4>
    <p class="text-gray-700 italic">
      “Kebahagiaan sejati bukan hanya tentang tertawa, tapi tentang momen ketika hati terasa ringan, napas lebih lapang, dan dunia terlihat lebih indah dari biasanya.  
      Saat kamu bahagia, otakmu melepaskan dopamin dan itu bukan sekadar perasaan, tapi sinyal bahwa kamu hidup di saat terbaikmu.”
    </p>
  </div>

  <div id="quote2" class="quote-section max-w-2xl mx-auto mt-12 text-center p-6">
    <h4 class="text-2xl mb-2 font-semibold text-yellow-600">😄 Bahagia</h4>
    <p class="text-gray-700 italic">
      “Rasa bahagia tidak selalu datang dari hal besar. Kadang hanya dari secangkir kopi, angin sore, atau senyum kecil.  
      Saat bahagia, pikiranmu terbuka dan itulah saat di mana peluang baik sering datang tanpa kamu sadari.”
    </p>
  </div>

  <div id="quote3" class="quote-section max-w-2xl mx-auto mt-12 text-center p-6">
    <h4 class="text-2xl mb-2 font-semibold text-yellow-600">😕 Bimbang</h4>
    <p class="text-gray-700 italic">
      “Kebingungan bukan tanda kelemahan tapi tanda bahwa kamu sedang tumbuh. Otakmu sedang mencoba memahami pilihan hidup.  
      Jangan takut bimbang, karena dari situlah keputusan penting sering lahir.”
    </p>
  </div>

  <div id="quote4" class="quote-section max-w-2xl mx-auto mt-12 text-center p-6">
    <h4 class="text-2xl mb-2 font-semibold text-yellow-600">😰 Cemas</h4>
    <p class="text-gray-700 italic">
      “Kecemasan adalah mekanisme alami tubuhmu yang berkata: ‘Aku ingin aman.’  
      Jangan lawan, peluklah ia perlahan. Ingat, kamu lebih kuat dari pikiran burukmu sendiri.”
    </p>
  </div>
  
   <div id="quote5" class="quote-section max-w-2xl mx-auto mt-12 text-center p-6">
    <h4 class="text-2xl mb-2 font-semibold text-yellow-600">😐 Biasa Saja</h4>
    <p class="text-gray-700 italic">
      “Tidak semua hari harus penuh warna atau badai.  
      Kadang hari yang tenang dan biasa saja justru memberi ruang bagi pikiran dan hati untuk beristirahat.  
      Hari yang datar bukan berarti buruk, itu berarti kamu sedang memberi tubuh dan jiwa waktu untuk bernapas.”
    </p>
  </div>

  <div id="quote6" class="quote-section max-w-2xl mx-auto mt-12 text-center p-6">
    <h4 class="text-2xl mb-2 font-semibold text-yellow-600">😢 Sedih</h4>
    <p class="text-gray-700 italic">
      “Kesedihan adalah cara hati berbicara, bukan tanda kelemahan.  
      Saat kamu mengizinkan diri merasakannya, kamu sedang memberi ruang bagi dirimu untuk sembuh.”
    </p>
  </div>

  <div id="quote7" class="quote-section max-w-2xl mx-auto mt-12 text-center p-6">
    <h4 class="text-2xl mb-2 font-semibold text-yellow-600">😭 Sangat Sedih</h4>
    <p class="text-gray-700 italic">
      “Menangis bukan kelemahan, tapi bukti kamu pernah berjuang.  
      Di saat air mata jatuh, tubuhmu sedang membersihkan luka batin agar kamu bisa bangkit lagi esok.”
    </p>
  </div>

  <div id="quote8" class="quote-section max-w-2xl mx-auto mt-12 text-center p-6">
    <h4 class="text-2xl mb-2 font-semibold text-yellow-600">😠 Marah</h4>
    <p class="text-gray-700 italic">
      “Marah bukan musuh, ia adalah alarm bahwa ada batas yang dilanggar.  
      Belajarlah mendengar kemarahanmu, bukan melawannya. Di situlah kamu mulai mengendalikan, bukan dikendalikan.”
    </p>
  </div>

  <div id="quote9" class="quote-section max-w-2xl mx-auto mt-12 text-center p-6">
    <h4 class="text-2xl mb-2 font-semibold text-yellow-600">😡 Sangat Marah</h4>
    <p class="text-gray-700 italic">
      “Di balik kemarahan yang besar sering tersembunyi luka yang dalam.  
      Saat kamu mulai memahami sumbernya, saat itulah kekuatanmu untuk sembuh benar-benar dimulai.”
    </p>
  </div>
 <footer class="bg-black text-yellow-400 mt-16 py-10 px-6">
      <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">



        <!-- Tentang YoMooD -->
        <div>
          <h3 class="text-2xl font-bold mb-3">Tentang YoMooD</h3>
          <p class="text-gray-300 leading-relaxed">
            YoMooD lahir dari keresahan banyak orang yang sering kali tidak menyadari emosi mereka sendiri. 
            Kami percaya bahwa memahami mood adalah langkah pertama untuk mengenali diri, 
            mengelola stres, dan menciptakan hidup yang lebih seimbang.
            <br><br>
            Web ini dirancang sebagai teman refleksi harianmu, 
            bukan hanya sekadar pelacak mood, tapi juga cermin kecil untuk jiwamu.
          </p>
        </div>

        <!-- Visi & Misi -->
        <div>
          <h3 class="text-2xl font-bold mb-3">Visi & Misi</h3>
          <ul class="text-gray-300 space-y-2 list-disc list-inside">
            <li><b>Visi:</b> Membantu setiap individu memahami dan merawat kesehatannya secara emosional dengan lebih sadar dan ringan.</li>
            <li><b>Misi:</b> 
              <ul class="list-disc list-inside ml-4">
                <li>Menyediakan ruang aman untuk merefleksikan perasaan setiap hari.</li>
                <li>Membangun kebiasaan mengenali mood secara jujur dan penuh kasih.</li>
                <li>Mendorong pengguna lebih terhubung dengan diri sendiri tanpa tekanan.</li>
              </ul>
            </li>
          </ul>
        </div>
      </div>

      <div class="border-t border-yellow-600 mt-8 pt-4 text-center text-gray-400 text-sm">
        © 2025 YoMooD ... “Moodmu bukan kelemahan, tapi jendela untuk memahami siapa dirimu.”
      </div>
    </footer>

  <script>
    function showQuote(id) {
      document.querySelectorAll('.quote-section').forEach(q => q.classList.remove('active'));
      const el = document.getElementById(id);
      el.classList.add('active');
      el.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
  </script>
    </div>

<script>
    // Percikan logo
    const logo = document.getElementById('logoMain');
    logo.addEventListener('click', () => {
        for (let i = 0; i < 25; i++) {
            const spark = document.createElement('div');
            spark.classList.add('spark');

            const angle = (Math.random() * Math.PI) - Math.PI / 2;
            const distance = Math.random() * 200 + 50;
            const x = Math.cos(angle) * distance;
            const y = Math.sin(angle) * distance;

            spark.style.setProperty('--x', `${x}px`);
            spark.style.setProperty('--y', `${y}px`);

            logo.parentElement.appendChild(spark);
            setTimeout(() => spark.remove(), 800);
        }
    });

    // Klik emoji untuk scroll ke deskripsi
    const emojis = document.querySelectorAll('.emoji');
    emojis.forEach(emoji => {
        emoji.addEventListener('click', () => {
            const targetId = emoji.getAttribute('data-target');
            const targetEl = document.getElementById(targetId);
            if (targetEl) {
                targetEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    });

    
</script>

</body>
</html>
