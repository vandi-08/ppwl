<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Waktu Terbaik untuk Memantau Suasana Hati | YoMooD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-yellow-50 text-gray-900 flex flex-col min-h-screen">

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

<!-- Blog -->
<div class="max-w-3xl mx-auto my-12 p-6 bg-white shadow-lg rounded-lg">
    <div class="relative mb-6">
        <div class="absolute -inset-2 bg-yellow-300 rounded-lg -z-10"></div>
        <img src="{{ asset('images/blog/blog4.png') }}" alt="Gambar Blog 4" class="w-72 h-72 object-cover rounded-lg mx-auto shadow-lg">
    </div>

    <h1 class="text-3xl font-bold text-black mb-4 text-center">Waktu Terbaik untuk Memantau Suasana Hati</h1>

    <p class="text-gray-700 mb-4">
        Memantau suasana hati bukan hanya tentang mencatat apakah kamu sedang senang atau sedih. 
        Ini adalah cara untuk mengenal diri sendiri lebih dalam. 
        Namun, banyak orang tidak tahu kapan waktu terbaik untuk melakukannya.
    </p>

    <p class="text-gray-700 mb-4">
        Idealnya, catat suasana hatimu di pagi, siang, dan malam hari. 
        Pagi hari memberi gambaran tentang bagaimana perasaanmu setelah istirahat, 
        sementara siang hari menunjukkan bagaimana rutinitas memengaruhi mood-mu.
    </p>

    <p class="text-gray-700 mb-4">
        Malam hari menjadi waktu refleksi terbaik. 
        Di saat semua aktivitas selesai, kamu bisa melihat apa yang membuatmu merasa lebih baik atau justru sebaliknya.
    </p>

    <p class="text-gray-700 mb-4">
        Dengan konsistensi, kamu akan mulai melihat pola: hari-hari tertentu lebih cerah, aktivitas tertentu membuatmu lebih tenang. 
        Dari sanalah, kamu bisa mulai mengatur kehidupanmu agar lebih selaras dengan kebutuhan emosionalmu.
    </p>

    <div class="text-center mt-8">
        <a href="{{ route('blog') }}" class="bg-black text-yellow-400 px-5 py-2 rounded hover:bg-yellow-400 hover:text-black transition">← Kembali ke Blog</a>
    </div>
</div>

</body>
</html>
