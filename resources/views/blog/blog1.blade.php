<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cara Bahagia Dalam Hubungan | YoMooD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-yellow-50 text-gray-900 flex flex-col min-h-screen">

    <!-- 🌙 Navbar -->
    <div class="flex justify-between items-center bg-black text-yellow-400 px-8 py-4 shadow-lg sticky top-0 z-50">
        <div class="flex items-center gap-2">
            <a href="/">
                <img id="logo" src="{{ asset('images/logo.png') }}" alt="YoMooD Logo"
                     class="w-8 h-8 hover:scale-110 transition cursor-pointer">
            </a>
            <a href="/" class="text-xl font-bold hover:text-white transition">YoMooD</a>
        </div>
        <div class="space-x-6">
            <a href="/blog" class="text-yellow-400 hover:text-white font-semibold">Blog</a>
            <a href="/login" class="bg-yellow-400 text-black px-3 py-1 rounded hover:bg-yellow-300 transition">Login</a>
        </div>
    </div>

    <!-- 🌻 Konten Utama Blog -->
    <div class="max-w-3xl mx-auto my-12 p-6 bg-white shadow-xl rounded-2xl">
        <img src="{{ asset('images/blog/blog1.png') }}" alt="Gambar Blog 1" class="w-72 h-72 object-cover rounded-lg mx-auto shadow-lg">

        <h1 class="text-4xl font-extrabold text-black mb-6 text-center">
            Cara Bahagia Dalam Hubungan
        </h1>

        <p class="text-gray-700 mb-5 leading-relaxed text-lg">
            Bahagia dalam hubungan bukanlah sesuatu yang terjadi begitu saja. Ia tumbuh perlahan dari hal-hal kecil yang dilakukan dengan niat baik setiap hari. Sebuah hubungan yang sehat dimulai dari kepercayaan dan rasa aman untuk menjadi diri sendiri. Saat kamu dan pasangan merasa diterima sepenuhnya, tidak perlu berpura-pura menjadi orang lain, di situlah cinta tumbuh dengan tulus. Kebahagiaan bukan soal siapa yang selalu benar, tetapi siapa yang mau saling mendengarkan dan memahami tanpa harus menghakimi.
        </p>

        <p class="text-gray-700 mb-5 leading-relaxed text-lg">
            Komunikasi yang jujur adalah dasar dari hubungan yang kuat. Banyak pasangan terjebak dalam salah paham hanya karena tidak mau terbuka. Padahal, mengungkapkan perasaan bukan tanda kelemahan, melainkan bukti keberanian untuk membangun kedekatan yang lebih dalam. Ketika kamu bisa mengatakan apa yang kamu rasakan, entah itu kegelisahan, ketakutan, atau kebahagiaan, kamu membuka ruang bagi pasangan untuk benar-benar mengenal dirimu. Dengan begitu, hubungan menjadi tempat yang aman, bukan ladang pertempuran ego.
        </p>

        <p class="text-gray-700 mb-5 leading-relaxed text-lg">
            Namun, hubungan bahagia juga tidak berarti harus selalu bersama setiap saat. Memberi ruang bagi diri sendiri adalah hal penting agar masing-masing individu tetap tumbuh. Waktu sendirian bukan bentuk menjauh, melainkan cara untuk menjaga keseimbangan batin. Ketika kamu punya waktu untuk merenung, mengembangkan minat, dan memperbaiki diri, kamu justru akan kembali ke hubungan dengan energi yang lebih positif dan pandangan yang lebih jernih.
        </p>

        <p class="text-gray-700 mb-5 leading-relaxed text-lg">
            Selain itu, peliharalah kebersamaan lewat hal-hal sederhana. Tidak perlu menunggu momen istimewa untuk menunjukkan cinta. Kadang, secangkir kopi di pagi hari, ucapan kecil seperti “terima kasih” atau “kamu luar biasa hari ini”, bisa berarti jauh lebih banyak daripada hadiah mahal. Hubungan yang bahagia dibangun dari rutinitas penuh kasih, bukan dari kejutan besar sesekali. Ingatlah bahwa perhatian kecil setiap hari jauh lebih kuat daripada janji besar yang jarang ditepati.
        </p>

        <p class="text-gray-700 mb-5 leading-relaxed text-lg">
            Terakhir, kebahagiaan dalam hubungan datang ketika kamu dan pasangan sama-sama berusaha, bukan menunggu salah satu pihak berubah. Cinta yang sehat tidak menuntut kesempurnaan, melainkan mengajarkan bagaimana menerima kekurangan dan belajar memperbaikinya bersama. Tidak ada hubungan tanpa tantangan, tetapi setiap masalah bisa menjadi kesempatan untuk tumbuh lebih dekat. Pada akhirnya, bahagia bukan berarti selalu tertawa, tetapi mampu melewati hari sulit dengan tangan yang tetap saling menggenggam.
        </p>

        <div class="text-center mt-10">
            <a href="{{ route('blog') }}" 
               class="bg-black text-yellow-400 px-6 py-3 rounded-full text-lg font-semibold hover:bg-yellow-400 hover:text-black transition duration-300 shadow-md">
                ← Kembali ke Daftar Blog
            </a>
        </div>
    </div>

</body>
</html>
