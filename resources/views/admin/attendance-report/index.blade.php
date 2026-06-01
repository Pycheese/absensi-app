@extends('admin.layouts.app')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    Absensi & Laporan
                </h1>

                <p class="text-gray-500 mt-1">
                    Rekap kehadiran karyawan berdasarkan jadwal dan tanggal
                </p>
            </div>

            <a href="{{ route('admin.attendance.report.export.excel', request()->query()) }}"
                class="bg-[#20BDE3] text-white px-5 py-3 rounded-xl text-sm font-medium shadow-sm">
                <i class="bi bi-download"></i>
                Export Excel
            </a>
        </div>

        {{-- FILTER --}}
        <form method="GET" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <div class="grid grid-cols-4 gap-4">

                <div>
                    <label class="block text-xs text-gray-500 mb-2">Tanggal</label>
                    <input type="date" name="date" value="{{ $selectedDate }}"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none">
                </div>

                <div>
                    <label class="block text-xs text-gray-500 mb-2">Karyawan</label>
                    <select name="user_id"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none">
                        <option value="">Semua Karyawan</option>

                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ (string) $selectedUser === (string) $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs text-gray-500 mb-2">Status</label>
                    <select name="status"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none">
                        <option value="">Semua Status</option>
                        <option value="hadir" {{ $selectedStatus === 'hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="terlambat" {{ $selectedStatus === 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                        <option value="tidak_hadir" {{ $selectedStatus === 'tidak_hadir' ? 'selected' : '' }}>Tidak Hadir
                        </option>
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit" class="w-full bg-[#20BDE3] text-white rounded-xl px-4 py-3 text-sm font-semibold">
                        Filter
                    </button>

                    <a href="{{ route('admin.attendance.report') }}"
                        class="bg-gray-100 text-gray-600 rounded-xl px-4 py-3 text-sm font-semibold">
                        Reset
                    </a>
                </div>

            </div>
        </form>

        {{-- SUMMARY --}}
        <div class="grid grid-cols-4 gap-6">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-green-100 flex items-center justify-center">
                    <i class="bi bi-check-circle-fill text-2xl text-green-500"></i>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Hadir</p>
                    <h2 class="text-3xl font-bold">{{ $presentToday }}</h2>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-orange-100 flex items-center justify-center">
                    <i class="bi bi-clock-fill text-2xl text-orange-500"></i>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Terlambat</p>
                    <h2 class="text-3xl font-bold">{{ $lateToday }}</h2>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-red-100 flex items-center justify-center">
                    <i class="bi bi-x-circle-fill text-2xl text-red-500"></i>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Tidak Hadir</p>
                    <h2 class="text-3xl font-bold">{{ $absentToday }}</h2>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-cyan-100 flex items-center justify-center">
                    <i class="bi bi-people-fill text-2xl text-cyan-500"></i>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Total Data</p>
                    <h2 class="text-3xl font-bold">{{ $reportRows->count() }}</h2>
                </div>
            </div>

        </div>

        {{-- TABLE --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            <div class="px-6 py-5 flex items-center justify-between border-b border-gray-100">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">
                        Detail Absensi
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Tanggal {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('d F Y') }}
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-500">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold">Karyawan</th>
                            <th class="px-6 py-4 text-left font-semibold">Brand</th>
                            <th class="px-6 py-4 text-left font-semibold">Sesi</th>
                            <th class="px-6 py-4 text-left font-semibold">Waktu Sesi</th>
                            <th class="px-6 py-4 text-left font-semibold">Masuk</th>
                            <th class="px-6 py-4 text-left font-semibold">Keluar</th>
                            <th class="px-6 py-4 text-left font-semibold">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse ($reportRows as $row)
                            @php
    $statusClass = match ($row->status) {
        'hadir' => 'bg-green-100 text-green-700',
        'terlambat' => 'bg-orange-100 text-orange-700',
        default => 'bg-red-100 text-red-700',
    };
                            @endphp

                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i class="bi bi-person-fill text-blue-500"></i>
                                        </div>

                                        <div>
                                            <p class="font-semibold text-gray-900">
                                                {{ $row->user->name }}
                                            </p>

                                            <p class="text-xs text-gray-400">
                                                ID {{ $row->user->id }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ $row->schedule->brand->name ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ $row->schedule->session_name }}
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ \Carbon\Carbon::parse($row->schedule->start_time)->format('H:i') }}
                                    -
                                    {{ \Carbon\Carbon::parse($row->schedule->end_time)->format('H:i') }}
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ $row->attendance?->check_in?->format('H:i') ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ $row->attendance?->check_out?->format('H:i') ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                        {{ $row->status_label }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                    Tidak ada data absensi pada tanggal ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </div>
@endsection