<!DOCTYPE html>
<<<<<<< HEAD
<html lang="en" class="light-style layout-menu-fixed" dir="ltr"
      data-theme="theme-default"
      data-assets-path="/assets/"
      data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title')</title>

  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

  <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
  <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>

<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">

    {{-- SIDEBAR --}}
    @include('layout.sidebar')

    <div class="layout-page">

      {{-- NAVBAR --}}
      @include('layout.navbar')

      <div class="content-wrapper">
        @yield('content')

        @include('layout.footer')
      </div>

    </div>
  </div>

  <div class="layout-overlay layout-menu-toggle"></div>
</div>

{{-- JS VENDOR --}}
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

{{-- SWEETALERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- SweetAlert Success --}}
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
    })
</script>
@endif

{{-- Delete Confirmation --}}
<script>
function deleteConfirm(id) {
    Swal.fire({
        title: 'Apakah kamu yakin?',
        text: "Data tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-'+id).submit();
        }
    });
}
</script>
=======
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
>>>>>>> 1394cbb (Add Laravel project files)

</body>
</html>
