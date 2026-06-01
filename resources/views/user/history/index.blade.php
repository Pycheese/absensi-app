@extends('user.layouts.app')

@section('content')
    <div class="min-h-screen bg-[#2FC3E6] relative pb-24 overflow-hidden">

        {{-- HEADER --}}
        <div class="px-8 pt-12 pb-8 flex items-center justify-between text-white">

            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="text-black text-4xl leading-none">
                    <i class="bi bi-chevron-left"></i>
                </a>

                <h1 class="text-3xl font-bold">
                    Riwayat
                </h1>
            </div>

            <a href="{{ route('history.calendar') }}"
                class="w-12 h-12 rounded-full bg-white/30 flex items-center justify-center">

                <i class="bi bi-calendar3 text-white text-2xl"></i>

            </a>

        </div>

        {{-- CONTENT --}}
        <div class="bg-white rounded-t-[40px] min-h-screen px-6 pt-8 pb-28">

            {{-- FILTER --}}
            <form method="GET" class="mb-6 grid grid-cols-2 gap-3">

                <input type="hidden" name="date" value="{{ request('date') }}">

                <select name="status" class="rounded-full bg-gray-100 px-4 py-2 text-sm text-gray-700">

                    <option value="">Semua Status</option>

                    <option value="hadir" {{ request('status') === 'hadir' ? 'selected' : '' }}>
                        Hadir
                    </option>

                    <option value="terlambat" {{ request('status') === 'terlambat' ? 'selected' : '' }}>
                        Terlambat
                    </option>

                    <option value="tidak_hadir" {{ request('status') === 'tidak_hadir' ? 'selected' : '' }}>
                        Tidak Hadir
                    </option>

                </select>

                <button class="rounded-full bg-[#2FC3E6] text-white text-sm font-semibold">
                    Filter
                </button>

            </form>

            {{-- STATISTIC --}}
            <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden mb-8">

                <div class="h-14 bg-gray-100 flex items-center justify-between px-6">

                    <h2 class="text-xl font-bold">
                        Statistik
                    </h2>

                    <i class="bi bi-graph-up text-2xl text-[#2FC3E6]"></i>

                </div>

                <div class="px-6 py-7 flex items-center gap-6">

                    <div class="w-24 h-24 rounded-full border-[7px] border-[#2FC3E6] flex items-center justify-center">

                        <span class="text-2xl text-[#2FC3E6] font-semibold">
                            {{ $attendancePercent }}%
                        </span>

                    </div>

                    <div class="flex-1 text-base">

                        <div class="flex justify-between border-b border-gray-200 py-1">
                            <span>Hadir</span>

                            <span class="text-green-600 font-semibold">
                                {{ $presentCount }}
                            </span>
                        </div>

                        <div class="flex justify-between border-b border-gray-200 py-1">
                            <span>Terlambat</span>

                            <span class="text-yellow-500 font-semibold">
                                {{ $lateCount }}
                            </span>
                        </div>

                        <div class="flex justify-between py-1">
                            <span>Tidak Hadir</span>

                            <span class="text-red-500 font-semibold">
                                {{ $absentCount }}
                            </span>
                        </div>

                    </div>

                </div>

            </div>

            {{-- DATE --}}
            <div class="mb-5">
                <span class="inline-flex px-4 py-2 rounded-full bg-[#EAF8FC] text-[#2FC3E6] text-sm font-medium">

                    {{ $selectedDate->translatedFormat('d F Y') }}

                </span>
            </div>

            {{-- LIST --}}
            <div class="space-y-4">

                @forelse($schedules as $schedule)

                    @php
                        $attendance = $schedule->attendance;

                        $statusClass = match ($schedule->history_status) {
                            'hadir' => 'bg-green-100 text-green-700',
                            'terlambat' => 'bg-yellow-100 text-yellow-700',
                            default => 'bg-red-100 text-red-700',
                        };
                    @endphp

                    <div class="bg-white rounded-2xl shadow-md border border-gray-100 px-5 py-4">

                        {{-- TOP --}}
                        <div class="flex justify-between items-start gap-3 mb-4">

                            <div>

                                <p class="text-sm text-gray-400">
                                    {{ $schedule->session_date->translatedFormat('D, d F Y') }}
                                </p>

                                <h3 class="text-lg font-semibold text-gray-900 mt-1">
                                    {{ $schedule->brand->name ?? 'Tanpa Brand' }}
                                </h3>

                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $schedule->session_name }}
                                </p>

                            </div>

                            <span class="text-xs px-3 py-1 rounded-full font-medium {{ $statusClass }}">

                                {{ $schedule->history_label }}

                            </span>

                        </div>

                        {{-- DETAIL --}}
                        <div class="grid grid-cols-2 gap-3 border-t border-gray-100 pt-4">

                            <div class="rounded-xl bg-blue-50 px-3 py-3">

                                <p class="text-xs text-gray-500">
                                    Absen Masuk
                                </p>

                                <p class="font-semibold text-blue-700 mt-1">

                                    {{ $attendance?->check_in?->format('H:i') ?? '-' }}

                                </p>

                            </div>

                            <div class="rounded-xl bg-purple-50 px-3 py-3">

                                <p class="text-xs text-gray-500">
                                    Absen Keluar
                                </p>

                                <p class="font-semibold text-purple-700 mt-1">

                                    {{ $attendance?->check_out?->format('H:i') ?? '-' }}

                                </p>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="bg-white rounded-2xl shadow-md px-5 py-10 text-center text-gray-400">

                        Belum ada riwayat absensi

                    </div>

                @endforelse

            </div>

        </div>

    </div>
@endsection