@extends('user.layouts.app')

@section('content')
        @php
    use Carbon\Carbon;
        @endphp

        <main class="min-h-screen bg-[#F5F5F5] pb-24">
            <section class="bg-[#2FC3E6] rounded-b-[28px] px-6 pt-9 pb-20 text-white relative">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-lg font-light">
                            Hello, <span class="font-semibold">{{ auth()->user()->name }}</span>
                        </p>
                        <p class="text-xs mt-1 text-white/85">Have a nice day!</p>
                    </div>

                <a href="{{ route('notifications.index') }}"
                    class="w-10 h-10 rounded-full bg-white/15 flex items-center justify-center">
                        <i class="bi bi-bell text-xl"></i>
                    </a>
                </div>
            </section>

            <section class="-mt-12 px-4 space-y-5">

                @if (session('success'))
                    <div class="rounded-2xl bg-green-50 border border-green-100 px-4 py-3 text-sm text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="rounded-2xl bg-red-50 border border-red-100 px-4 py-3 text-sm text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="bg-white rounded-[24px] shadow-md border border-gray-100 p-4">
                    <div class="flex items-center justify-between mb-4">
                        <h1 class="font-semibold text-gray-900">Sesi Hari ini</h1>
                        <span class="text-[11px] px-3 py-1 rounded-full bg-[#EAF8FC] text-[#2AAED0]">
                            {{ today()->translatedFormat('d M Y') }}
                        </span>
                    </div>

                    <div class="space-y-4">
                        @forelse ($todaySchedules as $schedule)
                            @php
        $attendance = $schedule->attendance ?? null;

        $isReady = $schedule->ui_status === 'ready';
        $isCheckedIn = $schedule->ui_status === 'checked_in';
        $isCompleted = $schedule->ui_status === 'completed';
        $isUpcoming = $schedule->ui_status === 'upcoming';
        $isExpired = $schedule->ui_status === 'expired';

        $badgeClass = match ($schedule->ui_status) {
            'ready' => 'bg-[#EAF8FC] text-[#2AAED0]',
            'checked_in' => 'bg-yellow-100 text-yellow-700',
            'completed' => 'bg-green-100 text-green-700',
            'expired' => 'bg-red-100 text-red-700',
            default => 'bg-gray-100 text-gray-500',
        };

        $iconBoxClass = match ($schedule->ui_status) {
            'ready' => 'bg-[#2FC3E6]',
            'checked_in' => 'bg-yellow-500',
            'completed' => 'bg-green-500',
            default => 'bg-gray-200',
        };

        $iconClass = match ($schedule->ui_status) {
            'completed' => 'bi-check2',
            'checked_in' => 'bi-hourglass-split',
            default => 'bi-display',
        };
                            @endphp

                            <article class="rounded-[20px] border border-gray-100 bg-white shadow-sm p-4">
                                <div class="flex items-start gap-3">
                                    <div class="w-11 h-11 rounded-xl {{ $iconBoxClass }} flex items-center justify-center shrink-0">
                                        <i
                                            class="bi {{ $iconClass }} {{ in_array($schedule->ui_status, ['ready', 'checked_in', 'completed']) ? 'text-white' : 'text-gray-500' }} text-xl"></i>
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between gap-2">
                                            <div>
                                                <span
                                                    class="inline-flex text-[10px] px-2 py-1 rounded-full bg-[#EAF8FC] text-[#2AAED0] mb-2">
                                                    {{ $schedule->session_name }}
                                                </span>

                                                <h2 class="font-semibold text-gray-900 leading-tight truncate">
                                                    {{ $schedule->brand->name ?? 'Tanpa Brand' }}
                                                </h2>

                                                <p class="text-xs text-gray-500 mt-1">
                                                    <i class="bi bi-clock"></i>
                                                    {{ Carbon::parse($schedule->start_time)->format('H:i') }} -
                                                    {{ Carbon::parse($schedule->end_time)->format('H:i') }}
                                                </p>
                                            </div>

                                            <span class="text-[10px] px-2.5 py-1 rounded-full whitespace-nowrap {{ $badgeClass }}">
                                                {{ $schedule->status_label }}
                                            </span>
                                        </div>

                                        <div class="border-t border-gray-200 mt-4 pt-3 space-y-3">
                                            <div class="flex items-center justify-between text-sm">
                                                <div class="flex items-center gap-3 text-gray-700">
                                                    <span
                                                        class="w-7 h-7 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                                                        <i class="bi bi-box-arrow-in-right"></i>
                                                    </span>
                                                    <span>Absen Masuk</span>
                                                </div>

                                                <span class="text-gray-400 text-xs">
                                                    {{ $attendance?->check_in?->format('H:i') ?? '-' }}
                                                </span>
                                            </div>

                                            <div class="flex items-center justify-between text-sm">
                                                <div class="flex items-center gap-3 text-gray-700">
                                                    <span
                                                        class="w-7 h-7 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center">
                                                        <i class="bi bi-box-arrow-left"></i>
                                                    </span>
                                                    <span>Absen Keluar</span>
                                                </div>

                                                <span class="text-gray-400 text-xs">
                                                    {{ $attendance?->check_out?->format('H:i') ?? '-' }}
                                                </span>
                                            </div>
                                        </div>

                                        @if ($schedule->can_check_in)
                                            <form action="{{ route('user.attendance.checkin', $schedule) }}" method="POST" class="mt-4">
                                                @csrf
                                                <button type="submit"
                                                    class="w-full h-11 rounded-xl bg-[#2FC3E6] text-white text-sm font-semibold flex items-center justify-center gap-2">
                                                    <i class="bi bi-box-arrow-in-right"></i>
                                                    Absen Masuk
                                                </button>
                                            </form>
                                        @elseif ($schedule->can_check_out)
                                            <form action="{{ route('user.attendance.checkout', $schedule) }}" method="POST"
                                                class="mt-4">
                                                @csrf
                                                <button type="submit"
                                                    class="w-full h-11 rounded-xl bg-purple-500 text-white text-sm font-semibold flex items-center justify-center gap-2">
                                                    <i class="bi bi-box-arrow-left"></i>
                                                    Absen Keluar
                                                </button>
                                            </form>
                                        @elseif ($isUpcoming)
                                            <div class="mt-4 rounded-xl bg-blue-50 px-4 py-3 flex items-start gap-3">
                                                <i class="bi bi-clock text-blue-500 text-2xl leading-none"></i>
                                                <div>
                                                    <p class="text-sm font-semibold text-blue-600">Sesi ini belum dimulai.</p>
                                                    <p class="text-xs text-gray-700 mt-1">
                                                        Absen akan tersedia pada
                                                        <span
                                                            class="font-semibold">{{ Carbon::parse($schedule->start_time)->format('H:i') }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        @elseif ($isCompleted)
                                            <div class="mt-4 rounded-xl bg-green-50 px-4 py-3 text-sm text-green-700 font-medium">
                                                <i class="bi bi-check-circle"></i>
                                                Absensi sesi ini sudah selesai.
                                            </div>
                                        @elseif ($isExpired)
                                            <div class="mt-4 rounded-xl bg-red-50 px-4 py-3 text-sm text-red-700 font-medium">
                                                <i class="bi bi-x-circle"></i>
                                                Waktu absen sesi ini sudah selesai.
                                            </div>
                                        @else
                                            <div class="mt-4 rounded-xl bg-gray-50 px-4 py-3 text-sm text-gray-600 font-medium">
                                                Menunggu status absensi.
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="rounded-[20px] bg-white border border-gray-100 py-10 text-center">
                                <div
                                    class="w-14 h-14 mx-auto rounded-2xl bg-[#EAF8FC] text-[#2FC3E6] flex items-center justify-center mb-3">
                                    <i class="bi bi-calendar-x text-2xl"></i>
                                </div>
                                <p class="font-semibold text-gray-800">Tidak ada sesi hari ini</p>
                                <p class="text-xs text-gray-500 mt-1">Jadwal sesi akan muncul di halaman ini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 p-4">
                    <div class="flex items-center justify-between mb-3">
                        <h2 class="font-semibold text-gray-900">Progres Bulan Ini</h2>
                        <span class="text-[#2FC3E6] font-semibold">{{ $attendancePercent }}%</span>
                    </div>

                    <div class="w-full h-2 rounded-full bg-gray-200 overflow-hidden">
                        <div class="h-full rounded-full bg-[#2FC3E6]" style="width: {{ $attendancePercent }}%"></div>
                    </div>

                    <div class="grid grid-cols-3 gap-3 mt-4 text-center">
                        <div class="rounded-2xl bg-gray-50 p-3">
                            <p class="text-lg font-semibold text-gray-900">{{ $monthlyTotal }}</p>
                            <p class="text-[11px] text-gray-500">Total Sesi</p>
                        </div>

                        <div class="rounded-2xl bg-green-50 p-3">
                            <p class="text-lg font-semibold text-green-700">{{ $monthlyPresent }}</p>
                            <p class="text-[11px] text-gray-500">Hadir</p>
                        </div>

                        <div class="rounded-2xl bg-yellow-50 p-3">
                            <p class="text-lg font-semibold text-yellow-600">{{ $monthlyLate }}</p>
                            <p class="text-[11px] text-gray-500">Telat</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
@endsection