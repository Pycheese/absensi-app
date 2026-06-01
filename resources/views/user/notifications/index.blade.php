@extends('user.layouts.app')

@section('content')
    <main class="min-h-screen bg-[#F5F5F5] pb-24">

        <section class="bg-[#2FC3E6] rounded-b-[28px] px-6 pt-10 pb-16 text-white">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}"
                    class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="bi bi-chevron-left text-xl"></i>
                </a>

                <div>
                    <h1 class="text-xl font-semibold">Notifikasi</h1>
                    <p class="text-xs text-white/80 mt-1">Info sesi dan absensi kamu</p>
                </div>
            </div>
        </section>

        <section class="-mt-8 px-4 space-y-4">
            @if ($upcomingSchedules->count() > 0)
                @foreach ($upcomingSchedules as $schedule)
                    <div class="bg-white rounded-[22px] shadow-sm border border-gray-100 p-4 flex gap-4">
                        <div class="w-11 h-11 rounded-2xl bg-[#EAF8FC] text-[#2FC3E6] flex items-center justify-center shrink-0">
                            <i class="bi bi-clock text-xl"></i>
                        </div>

                        <div class="flex-1">
                            <h2 class="font-semibold text-gray-900">
                                Sesi akan dimulai
                            </h2>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $schedule->brand->name ?? 'Tanpa Brand' }} - {{ $schedule->session_name }}
                            </p>

                            <p class="text-xs text-gray-400 mt-2">
                                Mulai pukul
                                <span class="font-semibold text-[#2FC3E6]">
                                    {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                </span>
                            </p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 px-6 py-12 text-center">
                    <div
                        class="w-16 h-16 rounded-2xl bg-[#EAF8FC] text-[#2FC3E6] mx-auto flex items-center justify-center mb-4">
                        <i class="bi bi-bell-slash text-3xl"></i>
                    </div>

                    <h2 class="font-semibold text-gray-900">Belum ada notifikasi</h2>
                    <p class="text-sm text-gray-500 mt-2">
                        Notifikasi sesi hari ini akan muncul di sini.
                    </p>
                </div>
            @endif
        </section>

    </main>
@endsection