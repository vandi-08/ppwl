<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'YoMooD - Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Modern clean font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .nav-link {
            position: relative;
            transition: .25s;
        }

        /* underline hover effect */
        .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -3px;
            width: 0;
            height: 2px;
            background: #FACC15;
            transition: .25s;
        }

        .nav-link:hover::after {
            width: 100%;
        }
    </style>
</head>
<body class="bg-yellow-50 text-gray-900 min-h-screen flex flex-col">

    <!-- Navbar -->
    <div class="flex justify-between items-center bg-black text-yellow-400 px-8 py-4 shadow-lg">
        <div class="flex items-center gap-3">
            <a href="{{ route('landing') }}">
                <img src="{{ asset('images/logo.png') }}" class="w-9 h-9 opacity-90 hover:opacity-100 hover:scale-110 transition cursor-pointer">
            </a>
            <a href="{{ route('landing') }}" class="text-2xl font-bold tracking-wide hover:text-yellow-300 transition">YoMooD</a>
        </div>

        <div class="flex items-center gap-6 text-sm font-medium">
            <a href="{{ route('user.dashboard') }}" class="nav-link hover:text-white">Dashboard</a>
            <a href="{{ route('user.riwayatMood') }}" class="nav-link hover:text-white">Riwayat Mood</a>
            <a href="{{ route('user.aktivitas') }}" class="nav-link hover:text-white">Aktivitas & Rekomendasi</a>
            <a href="/game" class="hover:text-white">Game Ringan</a>
            <a href="{{ route('user.insight') }}" class="nav-link hover:text-white">Insight</a>
            <a href="{{ route('user.profil') }}" class="nav-link hover:text-white">Profil</a>

            <a href="{{ url('/logout') }}" class="bg-yellow-400 text-black px-4 py-1.5 rounded-lg font-semibold hover:bg-yellow-300 transition">
                Logout
            </a>
        </div>
    </div>

    <!-- Konten utama -->
    <div class="flex-1 text-gray-900 overflow-y-auto p-6">
        @yield('content')
    </div>

</body>
</html>
