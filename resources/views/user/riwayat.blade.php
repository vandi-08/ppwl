@extends('user.layout')

@section('title', 'Riwayat Mood - YoMooD')

@section('content')
<div class="max-w-4xl mx-auto p-6">

    <!-- TITLE -->
    <h1 class="text-4xl font-extrabold text-gray-900 mb-6 flex items-center gap-2">
        <span class="text-yellow-500">⟳</span> Riwayat Mood Kamu
    </h1>

    @if($entries->count())

        <div class="space-y-5">

            @foreach($entries as $entry)
            <div class="group bg-white shadow-xl rounded-3xl p-5 border border-yellow-300/30
                        hover:border-yellow-400 hover:shadow-yellow-300/30 transition duration-300">

                <div class="flex justify-between items-start">

                    <!-- LEFT SIDE -->
                    <div class="flex items-center gap-4">

                        <!-- EMOJI BUBBLE -->
                        <div class="text-5xl bg-yellow-100 group-hover:bg-yellow-200 transition
                                    p-4 rounded-2xl shadow-inner">
                            {{ $entry->mood->emoji ?? '🙂' }}
                        </div>

                        <!-- TEXT INFO -->
                        <div>
                            <div class="font-bold text-xl text-gray-900">
                                {{ $entry->mood->name ?? 'Mood' }}
                            </div>

                            <div class="text-sm text-gray-600 mt-1">
                                {{ \Carbon\Carbon::parse($entry->created_at)->translatedFormat('d F Y | H:i') }}
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT SIDE NOTE -->
                    @if($entry->note)
                        <div class="max-w-xs text-right text-gray-700 italic bg-yellow-50 px-4 py-2 rounded-xl
                                    border border-yellow-300/40 shadow-inner">
                            “{{ $entry->note }}”
                        </div>
                    @endif
                </div>
            </div>
            @endforeach

        </div>

        <div class="mt-6">
            {{ $entries->links('pagination::tailwind') }}
        </div>

    @else
        <div class="bg-yellow-100 text-gray-900 p-6 rounded-2xl font-medium text-center shadow-md">
            Kamu belum mencatat mood apa pun. Cobalah mulai sekarang!
        </div>
    @endif
</div>
@endsection
