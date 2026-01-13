<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - YoMood Admin</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font modern -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .nav-link {
            position: relative;
            transition: .25s;
        }

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

<body class="bg-gray-900 text-yellow-400 min-h-screen flex flex-col">

    <!-- NAVBAR -->
    <nav class="w-full bg-black border-b border-yellow-500 px-8 py-4 flex items-center justify-between shadow-lg">

        <!-- Brand -->
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}"
                 class="w-9 h-9 opacity-90 hover:opacity-100 hover:scale-110 transition cursor-pointer">
            <span class="text-2xl font-bold tracking-wide">YoMood Admin</span>
        </div>

        <!-- Menu -->
        <div class="flex gap-6 text-base font-medium">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link hover:text-white {{ request()->routeIs('admin.dashboard') ? 'text-white' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('admin.users') }}"
               class="nav-link hover:text-white {{ request()->routeIs('admin.users') ? 'text-white' : '' }}">
                Users
            </a>

            <a href="{{ route('admin.activities') }}"
               class="nav-link hover:text-white {{ request()->routeIs('admin.activities') ? 'text-white' : '' }}">
                Aktivitas
            </a>

            <a href="{{ route('admin.analytics') }}"
               class="nav-link hover:text-white {{ request()->routeIs('admin.analytics') ? 'text-white' : '' }}">
                Analytics
            </a>
        </div>

        <!-- Logout -->
        <div>
            <a href="{{ route('logout') }}"
               class="bg-red-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-600 transition">
                Logout
            </a>
        </div>

    </nav>

    <!-- PAGE CONTENT -->
    <main class="flex-1 p-8 max-w-[1600px] mx-auto text-yellow-200">
        @yield('content')
    </main>

</body>
</html>
