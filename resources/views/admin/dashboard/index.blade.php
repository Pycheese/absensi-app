@extends('admin.layouts.app')

@section('content')
    <div class="space-y-5">

        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                <p class="text-sm text-gray-500 mt-1">Ringkasan absensi dan penggajian hari ini</p>
            </div>

            <div class="flex items-center gap-4">
                <div class="bg-white rounded-full px-4 py-2 flex items-center gap-2 shadow-sm border border-gray-100">
                    <i class="bi bi-search text-gray-400"></i>
                    <input type="text" placeholder="Search" class="bg-transparent outline-none text-sm w-36">
                </div>

                <i class="bi bi-bell text-gray-400 text-lg"></i>

            <a href="{{ route('admin.profile.index') }}" class="flex items-center gap-3 hover:opacity-80 transition">

                <div class="w-10 h-10 rounded-full bg-[#EAF8FC] text-[#20BDE3] flex items-center justify-center font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div>
                    <p class="text-sm font-semibold text-gray-800">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-xs text-gray-500">
                        Admin
                    </p>
                </div>

            </a>
            </div>
        </div>

        <div class="grid grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center">
                    <i class="bi bi-person-fill text-xl text-blue-500"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Total Karyawan</p>
                    <h2 class="text-2xl font-semibold text-gray-900">{{ $totalUsers }}</h2>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-cyan-100 flex items-center justify-center">
                    <i class="bi bi-calendar2-event text-xl text-cyan-500"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Sesi Hari Ini</p>
                    <h2 class="text-2xl font-semibold text-gray-900">{{ $totalTodaySchedules }}</h2>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-green-100 flex items-center justify-center">
                    <i class="bi bi-check-circle-fill text-xl text-green-500"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Hadir Hari Ini</p>
                    <h2 class="text-2xl font-semibold text-gray-900">{{ $presentToday }}</h2>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-orange-100 flex items-center justify-center">
                    <i class="bi bi-wallet2 text-xl text-orange-500"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Payroll Belum Dibayar</p>
                    <h2 class="text-2xl font-semibold text-gray-900">{{ $unpaidPayroll }}</h2>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-5">

            <div class="bg-white rounded-[22px] border border-gray-100 shadow-sm p-5">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-900">Kehadiran Hari Ini</h2>

                    <a href="{{ route('admin.attendance.report') }}"
                        class="text-xs px-4 py-2 border border-gray-200 rounded-full text-gray-500">
                        Lihat Semua
                    </a>
                </div>

                <div class="space-y-3">
                    <div class="rounded-2xl border border-gray-100 px-4 py-3 flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-green-500 text-white flex items-center justify-center">
                            <i class="bi bi-check-lg text-lg"></i>
                        </div>

                        <div class="flex-1">
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-sm font-medium">Hadir</p>
                                    <p class="text-xs text-gray-500">{{ $presentToday }}</p>
                                </div>
                                <p class="text-sm font-medium">{{ $presentPercent }}%</p>
                            </div>

                            <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: {{ $presentPercent }}%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-gray-100 px-4 py-3 flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-orange-400 text-white flex items-center justify-center">
                            <i class="bi bi-clock text-lg"></i>
                        </div>

                        <div class="flex-1">
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-sm font-medium">Terlambat</p>
                                    <p class="text-xs text-gray-500">{{ $lateToday }}</p>
                                </div>
                                <p class="text-sm font-medium">{{ $latePercent }}%</p>
                            </div>

                            <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                                <div class="bg-orange-400 h-2 rounded-full" style="width: {{ $latePercent }}%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-gray-100 px-4 py-3 flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-red-500 text-white flex items-center justify-center">
                            <i class="bi bi-x-lg text-lg"></i>
                        </div>

                        <div class="flex-1">
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-sm font-medium">Tidak Hadir</p>
                                    <p class="text-xs text-gray-500">{{ $absentToday }}</p>
                                </div>
                                <p class="text-sm font-medium">{{ $absentPercent }}%</p>
                            </div>

                            <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                                <div class="bg-red-400 h-2 rounded-full" style="width: {{ $absentPercent }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[22px] border border-gray-100 shadow-sm p-5">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-900">Aktivitas Terbaru</h2>

                    <a href="{{ route('admin.attendance.report') }}"
                        class="text-xs px-4 py-2 border border-gray-200 rounded-full text-gray-500">
                        Lihat Semua
                    </a>
                </div>

                <div class="space-y-2">
                    @forelse($latestAttendances as $attendance)
                        @php
    $statusClass = match ($attendance->status) {
        'terlambat' => 'bg-orange-100 text-orange-600',
        'selesai' => 'bg-blue-100 text-blue-600',
        default => 'bg-green-100 text-green-600',
    };
                        @endphp

                        <div class="flex items-center justify-between border border-gray-100 rounded-xl px-4 py-3">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center shrink-0">
                                    <i class="bi bi-person-fill text-gray-400"></i>
                                </div>

                                <p class="text-sm text-gray-800 truncate">
                                    {{ $attendance->user->name ?? '-' }}
                                    absen di
                                    {{ $attendance->schedule->brand->name ?? $attendance->schedule->session_name ?? '-' }}
                                </p>
                            </div>

                            <span class="px-3 py-1 rounded-full text-xs shrink-0 {{ $statusClass }}">
                                {{ ucfirst($attendance->status ?? 'hadir') }}
                            </span>
                        </div>
                    @empty
                        <p class="text-gray-400 text-sm">Belum ada aktivitas</p>
                    @endforelse
                </div>
            </div>

        </div>

        <div class="grid grid-cols-2 gap-5 items-start">

            <div class="bg-white rounded-[22px] border border-gray-100 shadow-sm p-5 overflow-hidden">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-900">Data Karyawan</h2>

                    <a href="{{ route('admin.employees.create') }}"
                        class="bg-[#20BDE3] text-white px-4 py-2 rounded-xl text-xs font-semibold hover:bg-[#18aaca]">
                        <i class="bi bi-plus-lg"></i>
                        Tambah
                    </a>
                </div>

                <table class="w-full table-fixed text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-gray-600 text-left">
                            <th class="px-3 py-2.5 rounded-l-lg w-[32%]">Nama</th>
                            <th class="px-3 py-2.5 w-[38%]">Email</th>
                            <th class="px-3 py-2.5 w-[15%]">Role</th>
                            <th class="px-3 py-2.5 rounded-r-lg w-[15%] text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($employees as $employee)
                            <tr class="border-b border-gray-100">
                                <td class="px-3 py-3">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                                            <i class="bi bi-person-fill text-blue-500"></i>
                                        </div>

                                        <span class="font-medium truncate">{{ $employee->name }}</span>
                                    </div>
                                </td>

                                <td class="px-3 py-3 text-gray-500 truncate">
                                    {{ $employee->email }}
                                </td>

                                <td class="px-3 py-3">
                                    <span class="px-2.5 py-1 rounded-full bg-green-100 text-green-700 text-xs">
                                        {{ ucfirst($employee->role) }}
                                    </span>
                                </td>

                                <td class="px-3 py-3">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.employees.edit', $employee->id) }}"
                                            class="w-8 h-8 rounded-lg border border-gray-200 text-gray-500 flex items-center justify-center">
                                            <i class="bi bi-pencil-square text-sm"></i>
                                        </a>

                                        <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button onclick="return confirm('Yakin ingin menghapus data ini?')"
                                                class="w-8 h-8 rounded-lg bg-red-500 text-white flex items-center justify-center">
                                                <i class="bi bi-trash text-sm"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-3 py-5 text-gray-400 text-sm">
                                    Belum ada data karyawan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="bg-white rounded-[22px] border border-gray-100 shadow-sm p-5 overflow-hidden">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-900">Absensi Terbaru</h2>

                    <a href="{{ route('admin.attendance.report') }}"
                        class="text-xs px-4 py-2 border border-gray-200 rounded-full text-gray-500">
                        Lihat Semua
                    </a>
                </div>

                <table class="w-full table-fixed text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-left text-gray-600">
                            <th class="px-3 py-2.5 rounded-l-lg w-[25%]">Nama</th>
                            <th class="px-3 py-2.5 w-[35%]">Brand</th>
                            <th class="px-3 py-2.5 w-[20%]">Waktu</th>
                            <th class="px-3 py-2.5 rounded-r-lg w-[20%]">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($latestAttendances as $attendance)
                            @php
    $statusClass = match ($attendance->status) {
        'terlambat' => 'bg-orange-100 text-orange-600',
        'selesai' => 'bg-blue-100 text-blue-600',
        default => 'bg-green-100 text-green-600',
    };
                            @endphp

                            <tr class="border-b border-gray-100">
                                <td class="px-3 py-3 truncate">
                                    {{ $attendance->user->name ?? '-' }}
                                </td>

                                <td class="px-3 py-3 text-gray-500 truncate">
                                    {{ $attendance->schedule->brand->name ?? $attendance->schedule->session_name ?? '-' }}
                                </td>

                                <td class="px-3 py-3 text-gray-500">
                                    {{ $attendance->created_at ? $attendance->created_at->format('H:i') : '-' }}
                                </td>

                                <td class="px-3 py-3">
                                    <span class="px-2.5 py-1 rounded-full text-xs {{ $statusClass }}">
                                        {{ ucfirst($attendance->status ?? 'hadir') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-3 py-5 text-gray-400 text-sm">
                                    Belum ada absensi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </div>
@endsection