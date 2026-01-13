@extends('layouts.admin')

@section('title', 'Kelola Aktivitas')

@section('content')

<h1 class="text-3xl font-bold text-yellow-400 mb-6">Kelola Aktivitas</h1>

{{-- Notification --}}
@if(session('success'))
    <div class="bg-green-500 text-black px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

{{-- Form Tambah aktivitas --}}
<div class="bg-black border border-yellow-500 p-6 rounded-xl mb-10 shadow-lg">
    <h2 class="text-xl font-bold text-yellow-400 mb-4">Tambah Aktivitas Baru</h2>

    <form action="{{ route('admin.activities.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-yellow-300 mb-1 font-medium">Nama Aktivitas</label>
            <input type="text" name="activity_name" class="w-full px-3 py-2 rounded bg-gray-800 text-white" required>
        </div>

        <div class="mb-4">
            <label class="block text-yellow-300 mb-1 font-medium">Deskripsi</label>
            <textarea name="description" class="w-full px-3 py-2 rounded bg-gray-800 text-white"></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-yellow-300 mb-1 font-medium">Durasi (Opsional)</label>
            <input type="text" name="duration" placeholder="contoh: 10 menit"
                   class="w-full px-3 py-2 rounded bg-gray-800 text-white">
        </div>

        <button class="bg-yellow-400 text-black px-4 py-2 rounded-lg font-semibold hover:bg-yellow-300 transition">
            Tambah Aktivitas
        </button>
    </form>
</div>

{{-- Table List Aktivitas --}}
<div class="bg-black border border-yellow-500 p-6 rounded-xl shadow-lg">
    <h2 class="text-xl font-bold text-yellow-400 mb-4">Daftar Aktivitas</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full text-left border-collapse rounded-xl overflow-hidden shadow-md">
            <thead class="bg-yellow-500 text-black font-semibold">
                <tr>
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">Nama Aktivitas</th>
                    <th class="px-6 py-3">Durasi</th>
                    <th class="px-6 py-3 w-[450px]">Deskripsi</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-yellow-600 text-white">
                @forelse($activities as $act)
                <tr class="hover:bg-gray-800 transition">
                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 font-semibold">{{ $act->activity_name }}</td>
                    <td class="px-6 py-4">{{ $act->duration ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $act->description ?? '-' }}</td>

                    {{-- Aksi --}}
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-3">
                            <button
                                onclick="openEdit({{ $act->id }}, '{{ $act->activity_name }}', '{{ $act->description }}', '{{ $act->duration }}')"
                                class="bg-blue-500 text-white px-3 py-1.5 rounded-lg hover:bg-blue-600 transition">
                                Edit
                            </button>

                            <form action="{{ route('admin.activities.destroy', $act->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus aktivitas ini?')">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="bg-red-500 text-white px-3 py-1.5 rounded-lg hover:bg-red-600 transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-400">Belum ada aktivitas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Edit --}}
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-60 hidden justify-center items-center">
    <div class="bg-gray-800 p-6 rounded-xl w-96 shadow-xl">
        <h2 class="text-xl font-bold text-yellow-400 mb-4">Edit Aktivitas</h2>

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="id">

            <div class="mb-3">
                <label class="block mb-1">Nama Aktivitas</label>
                <input type="text" name="activity_name" class="w-full px-3 py-2 rounded bg-gray-700 text-white">
            </div>

            <div class="mb-3">
                <label class="block mb-1">Deskripsi</label>
                <textarea name="description" class="w-full px-3 py-2 rounded bg-gray-700 text-white"></textarea>
            </div>

            <div class="mb-3">
                <label class="block mb-1">Durasi</label>
                <input type="text" name="duration" class="w-full px-3 py-2 rounded bg-gray-700 text-white">
            </div>

            <div class="flex justify-between mt-4">
                <button type="button" class="bg-gray-600 px-4 py-2 rounded-lg text-white"
                        onclick="closeModal()">Batal</button>

                <button class="bg-yellow-400 text-black px-4 py-2 rounded-lg hover:bg-yellow-300 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script Modal --}}
<script>
    function openEdit(id, name, desc, duration) {
        document.getElementById('editModal').classList.remove('hidden');
        document.querySelector('#editForm input[name=id]').value = id;
        document.querySelector('#editForm input[name=activity_name]').value = name;
        document.querySelector('#editForm textarea[name=description]').value = desc;
        document.querySelector('#editForm input[name=duration]').value = duration;
        document.getElementById('editForm').action = `/admin/activities/${id}`;
    }

    function closeModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>

@endsection
