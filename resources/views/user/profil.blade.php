@extends('user.layout')

@section('title', 'Profil & Pengaturan - YoMooD')

@section('content')
<div class="max-w-4xl mx-auto space-y-10 p-6">

    <!-- Header -->
    <div class="border-b border-gray-200 pb-4">
        <h1 class="text-3xl font-bold text-gray-900 tracking-wide">Profil & Pengaturan</h1>
        <p class="text-gray-600 text-sm mt-1">Kelola informasi akun dan keamanan Anda.</p>
    </div>

    {{-- Update Informasi Profil --}}
    <div class="bg-white shadow-lg rounded-2xl p-8 border border-gray-200">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Informasi Akun</h2>

        <form action="{{ route('user.updateProfile') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label class="block mb-1 text-gray-700 font-medium">Nama Pengguna</label>
                <input type="text" name="username" value="{{ Auth::user()->username }}"
                    class="w-full p-3 border border-gray-300 rounded-lg text-gray-900 focus:ring-yellow-400 focus:border-yellow-400 transition">
            </div>

            <div>
                <label class="block mb-1 text-gray-700 font-medium">Email</label>
                <input type="email" name="email" value="{{ Auth::user()->email }}"
                    class="w-full p-3 border border-gray-300 rounded-lg text-gray-900 focus:ring-yellow-400 focus:border-yellow-400 transition">
            </div>

            <button class="w-full bg-yellow-400 text-black font-semibold py-3 rounded-lg hover:bg-yellow-300 transition">
                Simpan Perubahan
            </button>
        </form>
    </div>

    {{-- Ubah Password --}}
    <div class="bg-white shadow-lg rounded-2xl p-8 border border-gray-200">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Keamanan Akun</h2>

        <form action="{{ route('user.updatePassword') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block mb-1 text-gray-700 font-medium">Password Lama</label>
                <input type="password" name="current_password"
                    class="w-full p-3 border border-gray-300 rounded-lg text-gray-900 focus:ring-yellow-400 focus:border-yellow-400 transition">
            </div>

            <div>
                <label class="block mb-1 text-gray-700 font-medium">Password Baru</label>
                <input type="password" name="new_password"
                    class="w-full p-3 border border-gray-300 rounded-lg text-gray-900 focus:ring-yellow-400 focus:border-yellow-400 transition">
            </div>

            <div>
                <label class="block mb-1 text-gray-700 font-medium">Konfirmasi Password Baru</label>
                <input type="password" name="new_password_confirmation"
                    class="w-full p-3 border border-gray-300 rounded-lg text-gray-900 focus:ring-yellow-400 focus:border-yellow-400 transition">
            </div>

            <button class="w-full bg-black text-yellow-400 font-semibold py-3 rounded-lg hover:bg-gray-900 transition">
                Update Password
            </button>
        </form>
    </div>

</div>
@endsection
