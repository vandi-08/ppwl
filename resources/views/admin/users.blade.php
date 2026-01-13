@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<h1 class="text-3xl font-bold mb-8">User Management 👤</h1>

<div class="overflow-x-auto bg-black rounded-xl shadow border border-yellow-500">
<table class="min-w-full text-sm">
    <thead class="bg-yellow-500 text-black">
        <tr>
            <th class="px-4 py-3 text-left">Username</th>
            <th class="px-4 py-3 text-center">Joined</th>
            <th class="px-4 py-3 text-center">Total Mood</th>
            <th class="px-4 py-3 text-center">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $user)
        <tr class="border-b border-gray-700 hover:bg-gray-800">
            <td class="px-4 py-3">{{ $user->username }}</td>

            <td class="px-4 py-3 text-center">
                {{ optional($user->created_at)->format('d M Y') ?? '-' }}
            </td>

            <td class="px-4 py-3 text-center">
                {{ $user->mood_entries_count }}
            </td>

            <td class="px-4 py-3 text-center">
                @if($user->is_active)
                    <span class="text-green-400 font-semibold">Aktif</span>
                @else
                    <span class="text-red-400 font-semibold">Tidak Aktif</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center py-6 text-gray-400">
                Tidak ada user
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>
@endsection
