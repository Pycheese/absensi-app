@extends('admin.layouts.app')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>

            <div class="flex items-center gap-4">
                <div class="bg-white rounded-full px-4 py-2 flex items-center gap-2 shadow-sm">
                    <i class="bi bi-search text-gray-400"></i>
                    <input type="text" placeholder="Search" class="bg-transparent outline-none text-sm w-36">
                </div>

                <i class="bi bi-bell text-gray-400 text-lg"></i>

                <div class="w-11 h-11 rounded-full bg-blue-100 overflow-hidden">
                    <img src="{{ asset('images/avatar.png') }}" class="w-full h-full object-cover">
                </div>
            </div>
        </div>

        {{-- SUMMARY CARDS --}}
        <div class="grid grid-cols-4 gap-6">

            <div class="bg-white rounded-xl shadow-md p-5 flex items-center gap-4">
                <i class="bi bi-person-fill text-3xl text-blue-500"></i>
                <div>
                    <p class="text-sm text-gray-600">Total Karyawan</p>
                    <h2 class="text-3xl font-bold">{{ $totalUsers }}</h2>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-5 flex items-center gap-4">
                <i class="bi bi-calendar2-event text-3xl text-cyan-500"></i>
                <div>
                    <p class="text-sm text-gray-600">Total Sesi Hari Ini</p>
                    <h2 class="text-3xl font-bold">{{ $totalTodaySchedules }}</h2>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-5 flex items-center gap-4">
                <i class="bi bi-check-circle-fill text-3xl text-green-500"></i>
                <div>
                    <p class="text-sm text-gray-600">Hadir</p>
                    <h2 class="text-3xl font-bold">{{ $weeklyPresent }}</h2>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-5 flex items-center gap-4">
                <i class="bi bi-x-circle-fill text-3xl text-red-500"></i>
                <div>
                    <p class="text-sm text-gray-600">Tidak Hadir</p>
                    <h2 class="text-3xl font-bold">{{ $weeklyAbsent }}</h2>
                </div>
            </div>

        </div>

        {{-- TOP CONTENT --}}
        <div class="grid grid-cols-2 gap-8">

            {{-- KEHADIRAN --}}
            <div class="bg-white rounded-2xl shadow-md p-6">

                <div class="flex justify-between items-center mb-5">
                    <h2 class="text-2xl font-semibold">Kehadiran Minggu Ini</h2>
                    <button class="text-xs px-4 py-2 border rounded-full text-gray-500">Lihat Semua</button>
                </div>

                <div class="space-y-5">

                    <div class="bg-white rounded-xl shadow-md p-4 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-green-500 text-white flex items-center justify-center">
                            <i class="bi bi-check-lg text-2xl"></i>
                        </div>

                        <div class="flex-1">
                            <div class="flex justify-between">
                                <div>
                                    <p class="font-medium">Hadir</p>
                                    <p class="text-sm text-gray-500">{{ $weeklyPresent }}</p>
                                </div>
                                <p class="text-sm font-medium">{{ $presentPercent }}%</p>
                            </div>

                            <div class="w-full bg-gray-300 rounded-full h-3 mt-2">
                                <div class="bg-green-500 h-3 rounded-full" style="width: {{ $presentPercent }}%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md p-4 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-orange-400 text-white flex items-center justify-center">
                            <i class="bi bi-asterisk text-2xl"></i>
                        </div>

                        <div class="flex-1">
                            <div class="flex justify-between">
                                <div>
                                    <p class="font-medium">Terlambat</p>
                                    <p class="text-sm text-gray-500">{{ $weeklyLate ?? 0 }}</p>
                                </div>
                                <p class="text-sm font-medium">{{ $latePercent }}%</p>
                            </div>

                            <div class="w-full bg-gray-300 rounded-full h-3 mt-2">
                                <div class="bg-orange-400 h-3 rounded-full" style="width: {{ $latePercent }}%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md p-4 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-red-500 text-white flex items-center justify-center">
                            <i class="bi bi-x-lg text-2xl"></i>
                        </div>

                        <div class="flex-1">
                            <div class="flex justify-between">
                                <div>
                                    <p class="font-medium">Tidak Hadir</p>
                                    <p class="text-sm text-gray-500">{{ $weeklyAbsent }}</p>
                                </div>
                                <p class="text-sm font-medium">{{ $absentPercent }}%</p>
                            </div>

                            <div class="w-full bg-gray-300 rounded-full h-3 mt-2">
                                <div class="bg-red-400 h-3 rounded-full" style="width: {{ $absentPercent }}%"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- AKTIVITAS --}}
            <div class="bg-white rounded-2xl shadow-md p-6">

                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Aktivitas Terbaru</h2>

                    <button class="text-sm px-5 py-2 border rounded-full text-gray-500">
                        Lihat Semua
                    </button>
                </div>

                <div class="space-y-3">
                    @forelse($latestAttendances as $attendance)
                        <div class="flex items-center justify-between border rounded-2xl px-5 py-4">

                            <div class="flex items-center gap-4 min-w-0">
                                <div class="w-11 h-11 rounded-full bg-gray-200 flex items-center justify-center shrink-0">
                                    <i class="bi bi-person-fill text-gray-400"></i>
                                </div>

                                <p class="text-gray-800 truncate">
                                    {{ $attendance->user->name ?? '-' }}
                                    absen di
                                    {{ $attendance->schedule->brand->name ?? $attendance->schedule->session_name ?? '-' }}
                                </p>
                            </div>

                            <span class="px-4 py-1 rounded-full bg-green-500 text-white text-sm shrink-0">
                                {{ ucfirst($attendance->status ?? 'hadir') }}
                            </span>

                        </div>
                    @empty
                        <p class="text-gray-400">Belum ada aktivitas</p>
                    @endforelse
                </div>

            </div>

        </div>

        {{-- BOTTOM CONTENT --}}
        <div class="grid grid-cols-2 gap-6 items-start">

            {{-- DATA KARYAWAN --}}
            <div class="bg-white rounded-2xl shadow-md p-6 overflow-hidden">

                <div class="flex justify-between items-center mb-5">
                    <h2 class="text-2xl font-semibold">Data Karyawan</h2>

                    <a href="{{ route('admin.employees.create') }}"
                        class="bg-[#20BDE3] text-white px-5 py-2 rounded-lg text-sm hover:bg-[#18aaca]">
                        <i class="bi bi-plus-lg"></i>
                        Tambah Karyawan
                    </a>
                </div>

                <div class="overflow-hidden">
                    <table class="w-full table-fixed">

                        <thead>
                            <tr class="bg-gray-300 text-gray-700 text-left">
                                <th class="px-4 py-3 rounded-l-lg w-[30%]">Nama</th>
                                <th class="px-4 py-3 w-[34%]">Email</th>
                                <th class="px-4 py-3 w-[18%]">Status</th>
                                <th class="px-4 py-3 rounded-r-lg w-[18%] text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($employees->take(4) as $employee)
                                <tr class="border-b">
                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-3 min-w-0">
                                            <div
                                                class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                                                <i class="bi bi-person-fill text-blue-500"></i>
                                            </div>

                                            <span class="font-medium truncate">
                                                {{ $employee->name }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="px-4 py-4 text-gray-500 text-sm truncate">
                                        {{ $employee->email }}
                                    </td>

                                    <td class="px-4 py-4">
                                        <span class="px-3 py-1 rounded-full bg-green-500 text-white text-xs">
                                            Aktif
                                        </span>
                                    </td>

                                    <td class="px-4 py-4">
                                        <div class="flex justify-center gap-2">

                                            <a href="{{ route('admin.employees.edit', $employee->id) }}"
                                                class="w-8 h-8 rounded-lg border text-gray-500 flex items-center justify-center">
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
                            @endforeach
                        </tbody>

                    </table>
                </div>

                <div class="flex justify-between items-center mt-6">
                    <p class="text-sm text-gray-400">Menampilkan data terbaru</p>

                    <div class="flex items-center gap-2">
                        <button
                            class="w-9 h-9 rounded-lg border border-gray-200 text-gray-400 hover:bg-gray-100 transition">
                            <i class="bi bi-chevron-left"></i>
                        </button>

                        <button class="w-9 h-9 rounded-lg bg-[#20BDE3] text-white font-medium">1</button>

                        <button
                            class="w-9 h-9 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-100 transition">2</button>

                        <button
                            class="w-9 h-9 rounded-lg border border-gray-200 text-gray-400 hover:bg-gray-100 transition">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                </div>

            </div>

            {{-- ABSENSI TERBARU --}}
            <div class="bg-white rounded-2xl shadow-md p-6 overflow-hidden">

                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Absensi Terbaru</h2>

                    <button class="text-sm px-5 py-2 border rounded-full text-gray-500">
                        Lihat Semua
                    </button>
                </div>

                <table class="w-full table-fixed">
                    <thead>
                        <tr class="bg-gray-300 text-left text-gray-700">
                            <th class="px-4 py-3 rounded-l-lg w-[25%]">Nama</th>
                            <th class="px-4 py-3 w-[35%]">Brand</th>
                            <th class="px-4 py-3 w-[20%]">Waktu</th>
                            <th class="px-4 py-3 rounded-r-lg w-[20%]">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($latestAttendances as $attendance)
                            <tr class="border-b text-sm">
                                <td class="px-4 py-4 truncate">
                                    {{ $attendance->user->name ?? '-' }}
                                </td>

                                <td class="px-4 py-4 text-gray-500 truncate">
                                    {{ $attendance->schedule->brand->name ?? $attendance->schedule->session_name ?? '-' }}
                                </td>

                                <td class="px-4 py-4 text-gray-500">
                                    {{ $attendance->created_at ? $attendance->created_at->format('H:i') : '-' }}
                                </td>

                                <td class="px-4 py-4">
                                    <span class="px-3 py-1 rounded-full bg-green-500 text-white text-xs">
                                        {{ ucfirst($attendance->status ?? 'hadir') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-5 text-gray-400">
                                    Belum ada absensi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="flex justify-between items-center mt-6">
                    <p class="text-sm text-gray-400">Menampilkan absensi terbaru</p>

                    <div class="flex items-center gap-2">
                        <button
                            class="w-9 h-9 rounded-lg border border-gray-200 text-gray-400 hover:bg-gray-100 transition">
                            <i class="bi bi-chevron-left"></i>
                        </button>

                        <button class="w-9 h-9 rounded-lg bg-[#20BDE3] text-white font-medium">1</button>

                        <button
                            class="w-9 h-9 rounded-lg border border-gray-200 text-gray-400 hover:bg-gray-100 transition">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection