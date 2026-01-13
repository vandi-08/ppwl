<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cara Mulai Memantau Suasana Hati Anda | YoMooD</title>
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
        <img src="{{ asset('images/blog/blog5.png') }}" alt="Gambar Blog 5" class="w-72 h-72 object-cover rounded-lg mx-auto shadow-lg">
    </div>

    <h1 class="text-3xl font-bold text-black mb-4 text-center">Cara Mulai Memantau Suasana Hati Anda</h1>

    <p class="text-gray-700 mb-4">
        Memantau suasana hati bukan sekadar menulis “hari ini aku bahagia” atau “aku sedih”. 
        Ini adalah langkah awal untuk memahami diri sendiri lebih dalam, 
        mengenali pemicu emosimu, dan membangun kebiasaan hidup yang lebih sehat.
    </p>

    <p class="text-gray-700 mb-4">
        Langkah pertama yang bisa kamu lakukan adalah memilih waktu tetap setiap hari untuk mencatat suasana hatimu. 
        Misalnya, sebelum tidur atau saat bangun pagi. 
        Dengan begitu, kamu dapat melihat perubahan emosimu secara konsisten dari hari ke hari.
    </p>

    <p class="text-gray-700 mb-4">
        Jangan takut untuk jujur. 
        Tidak ada yang salah dengan merasa sedih, marah, atau kecewa. 
        Justru dari perasaan itulah kamu bisa belajar mengenal dirimu dan apa yang kamu butuhkan.
    </p>

    <p class="text-gray-700 mb-4">
        Dengan mengakses <b>YoMooD</b>, kamu dapat mencatat, menganalisis, dan menemukan pola suasana hati dengan mudah. 
        Ini adalah awal dari perjalanan menjadi pribadi yang lebih sadar dan tenang.
    </p>

    <div class="text-center mt-8">
        <a href="{{ route('blog') }}" class="bg-black text-yellow-400 px-5 py-2 rounded hover:bg-yellow-400 hover:text-black transition">← Kembali ke Blog</a>
    </div>
</div>

</body>
</html>
