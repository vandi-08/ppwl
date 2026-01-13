<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - YoMooD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
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
        #logo {
            transition: all 0.6s ease-in-out;
            cursor: pointer;
        }
    </style>
</head>
<body class="bg-yellow-400 text-gray-900 h-screen flex items-center justify-center overflow-hidden relative">

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

    <!-- Kotak register -->
    <form action="/register" method="POST" class="bg-black bg-opacity-90 p-6 rounded-2xl shadow-2xl text-white w-80 z-10 backdrop-blur-sm">
        @csrf
        <h1 class="text-3xl font-bold text-yellow-400 mb-6 text-center tracking-wide">Daftar YoMooD</h1>

        <input type="text" name="username" placeholder="Nama pengguna" class="w-full p-2 mb-3 rounded text-black focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
        <input type="email" name="email" placeholder="Email" class="w-full p-2 mb-3 rounded text-black focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
        <input type="password" name="password" placeholder="Password" class="w-full p-2 mb-3 rounded text-black focus:outline-none focus:ring-2 focus:ring-yellow-400" required>

        <button type="submit" class="w-full bg-yellow-400 text-black font-semibold p-2 rounded hover:bg-yellow-500 transition">Daftar</button>

        <p class="text-center text-sm mt-4">Sudah punya akun? 
            <a href="/login" class="text-yellow-400 hover:underline">Masuk</a>
        </p>
    </form>

    <script>
        // Logo bergerak ke posisi acak
        const logo = document.getElementById('logo');
        logo.addEventListener('click', () => {
            const x = Math.random() * (window.innerWidth - 100);
            const y = Math.random() * (window.innerHeight - 100);
            logo.style.transform = `translate(${x}px, ${y}px) rotate(${Math.random() * 360}deg)`;
        });
    </script>

</body>
</html>
