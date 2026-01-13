<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Blog - YoMooD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-yellow-50 text-gray-900 min-h-screen">

    <!-- Navbar -->
    <div class="flex justify-between items-center bg-black text-yellow-400 px-8 py-4 shadow-lg">
        <div class="flex items-center gap-2">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="YoMooD Logo" class="w-8 h-8 hover:scale-110 transition">
            </a>
            <a href="/" class="text-xl font-bold hover:text-white transition">YoMooD</a>
        </div>
        <div class="space-x-6">
            <a href="/blog" class="text-yellow-400 hover:text-white font-semibold">Blog</a>
            <a href="/login" class="bg-yellow-400 text-black px-3 py-1 rounded hover:bg-yellow-300 transition">Login</a>
        </div>
    </div>

    <!-- Blog Content -->
    <div class="p-10">
        <h1 class="text-3xl font-bold text-center text-black mb-8">Artikel Pilihan YoMooD</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($blogs as $blog)
                <div class="bg-white shadow-lg rounded-2xl overflow-hidden hover:shadow-xl transition">
                    <img src="{{ $blog['image'] }}" alt="{{ $blog['title'] }}" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <span class="text-sm font-bold text-yellow-500 uppercase">{{ $blog['category'] }}</span>
                        <h2 class="text-xl font-bold text-gray-900 mt-2">{{ $blog['title'] }}</h2>
                        <p class="text-sm text-gray-600 mt-2">{{ $blog['excerpt'] }}</p>
                        <a href="{{ $blog['url'] }}" class="inline-block mt-3 text-yellow-500 hover:text-black transition font-semibold">Read More →</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
