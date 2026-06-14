@extends('user.layouts.app')

@section('content')

    @php
        use Carbon\Carbon;

        $today = Carbon::today()

    @endphp

    <div class="min-h-screen bg-[#2FC3E6] relative overflow-hidden pb-28">

        {{-- HEADER --}}
        <div class="px-5 pt-14 pb-10 text-white relative">

            <div class="flex justify-between items-start">

                <div>
                    <h1 class="text-[38px] font-bold leading-tight">
                        Schedule
                    </h1>

                    <p class="text-sm text-white/80 mt-1">
                        Jadwal sesi kamu
                    </p>
                </div>
                <a href="{{ route('user.schedule.calendar') }}"
                    class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center mt-1 active:scale-95 transition">
                    <i class="bi bi-calendar3 text-white text-2xl"></i>
                </a>

            </div>

            {{-- DATE BUTTON --}}
            <div class="mt-10">
                <a href="{{ route('user.schedule.calendar') }}"
                    class="w-full h-14 rounded-2xl bg-white text-[#2FC3E6] font-semibold flex items-center justify-center gap-2">
                    <i class="bi bi-calendar3 text-xl"></i>
                    Pilih Tanggal
                </a>
            </div>
        </div>

    </div>

    {{-- CONTENT --}}
    <div class="bg-[#F8F8F8] rounded-t-[42px] min-h-screen px-5 pt-8">

        <div class="flex items-center justify-between mb-8">

            <h2 class="text-[22px] font-semibold text-black">
                Upcoming Schedule
            </h2>

            <span class="text-xs bg-[#EAF8FC] text-[#2FC3E6] px-4 py-2 rounded-full">
                {{ $selectedDate->translatedFormat('d F Y') }}
            </span>

        </div>

        {{-- LIST --}}
        <div class="space-y-5">

            @forelse($schedules as $schedule)

                @php
                    $badgeClass = match ($schedule->ui_status) {
                        'ongoing' => 'bg-green-100 text-green-700',
                        'finished' => 'bg-gray-200 text-gray-600',
                        default => 'bg-blue-100 text-blue-700',
                    };

                    $duration = $schedule->start_datetime
                        ->diffInHours($schedule->end_datetime);
                @endphp

                <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 px-5 py-5">

                    {{-- TOP --}}
                    <div class="flex justify-between items-start gap-3">

                        <div>
                            <span class="inline-flex text-[10px] px-2 py-1 rounded-full bg-[#EAF8FC] text-[#2FC3E6] mb-3">
                                {{ $schedule->brand->name ?? 'Tanpa Brand' }}
                            </span>

                            <h3 class="text-[18px] text-black font-semibold leading-tight">
                                {{ $schedule->session_name }}
                            </h3>

                            <p class="text-xs text-gray-400 mt-2">
                                {{ $schedule->session_date->translatedFormat('l, d F Y') }}
                            </p>
                        </div>

                        <span class="text-[11px] px-3 py-1 rounded-full font-medium {{ $badgeClass }}">
                            {{ $schedule->status_label }}
                        </span>

                    </div>

                    {{-- DETAIL --}}
                    <div class="border-t border-gray-100 pt-4 mt-5 flex items-center">

                        {{-- TIME --}}
                        <div class="flex-1">

                            <p class="text-[11px] text-gray-400 mb-1">
                                Waktu
                            </p>

                            <p class="text-[14px] text-black font-medium">
                                {{ Carbon::parse($schedule->start_time)->format('H:i') }}
                                -
                                {{ Carbon::parse($schedule->end_time)->format('H:i') }}
                            </p>

                        </div>

                        {{-- DIVIDER --}}
                        <div class="w-px h-10 bg-gray-200 mx-5"></div>

                        {{-- DURATION --}}
                        <div class="flex-1">

                            <p class="text-[11px] text-gray-400 mb-1">
                                Durasi
                            </p>

                            <p class="text-[14px] text-black font-medium">
                                {{ $duration }} Jam
                            </p>

                        </div>

                    </div>

                </div>

            @empty

                <div class="bg-white rounded-2xl shadow-md px-5 py-12 text-center">

                    <div
                        class="w-16 h-16 rounded-2xl bg-[#EAF8FC] text-[#2FC3E6]
                                                                                                                                                                    mx-auto flex items-center justify-center mb-4">

                        <i class="bi bi-calendar-x text-3xl"></i>

                    </div>

                    <p class="font-semibold text-gray-800">
                        Belum ada schedule
                    </p>

                    <p class="text-sm text-gray-400 mt-2">
                        Jadwal sesi akan muncul di halaman ini.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

    </div>

@endsection