<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - YoMooD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Animasi mood bertebangan */
        .floating {
            position: absolute;
            font-size: 1.5rem;
            opacity: 0.7;
            animation: float 10s infinite ease-in-out;
        }
        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-40px) rotate(10deg); }
            100% { transform: translateY(0) rotate(-10deg); }
        }

        /* Transisi halus untuk logo */
        #logo {
            transition: all 0.6s ease-in-out;
            cursor: pointer;
        }
    </style>
</head>
<body class="bg-black text-white h-screen flex items-center justify-center overflow-hidden relative">

    <!-- Logo YoMooD -->
    <img id="logo" src="{{ asset('images/logo.png') }}" alt="YoMooD Logo" class="w-16 absolute top-6 left-6">

     <!-- Mood icons bertebangan -->
    <div class="floating text-yellow-400" style="top:20%; left:10%;">🤩</div>
    <div class="floating text-yellow-500" style="top:40%; left:80%;">😄</div>
    <div class="floating text-yellow-300" style="top:70%; left:20%;">😕</div>
    <div class="floating text-yellow-200" style="top:60%; left:60%;">😰</div>
    <div class="floating text-yellow-400" style="top:30%; left:40%;">😐</div>
    <div class="floating text-yellow-300" style="top:50%; left:15%;">😢</div>
    <div class="floating text-yellow-400" style="top:25%; left:70%;">😭</div>
    <div class="floating text-yellow-500" style="top:80%; left:50%;">😠</div>
    <div class="floating text-yellow-200" style="top:55%; left:85%;">😡</div>

    <!-- Kotak login -->
    <div class="w-80 bg-gray-900 p-6 rounded-2xl shadow-2xl z-10 backdrop-blur-sm bg-opacity-80">
        <!-- Notifikasi sukses -->
        @if (session('success'))
            <div class="bg-green-500 text-white text-center py-2 px-4 rounded mb-4 shadow">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-3xl font-bold text-yellow-400 mb-6 text-center tracking-wide">Masuk ke YoMooD</h1>

        <form action="/login" method="POST" class="space-y-3">
            @csrf
            <input type="email" name="email" placeholder="Email" class="w-full p-2 rounded text-black focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
            <input type="password" name="password" placeholder="Password" class="w-full p-2 rounded text-black focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
            <button type="submit" class="w-full bg-yellow-400 text-black font-semibold py-2 rounded hover:bg-yellow-500 transition">Masuk</button>
        </form>

        <p class="text-center text-sm mt-4">Belum punya akun? 
            <a href="/register" class="text-yellow-400 hover:underline">Daftar</a>
        </p>
    </div>

    <script>
        // Logo berpindah ke tempat acak setiap diklik
        const logo = document.getElementById('logo');
        logo.addEventListener('click', () => {
            const x = Math.random() * (window.innerWidth - 100);
            const y = Math.random() * (window.innerHeight - 100);
            logo.style.transform = `translate(${x}px, ${y}px) rotate(${Math.random() * 360}deg)`;
        });
    </script>

</body>
</html>
