@extends('admin.layouts.app')

@section('content')
    <div class="space-y-5">

        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Brand & Sesi</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola brand dan jadwal sesi live shopping</p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('admin.brands.create') }}"
                    class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-xl text-sm font-semibold">
                    <i class="bi bi-plus-lg"></i>
                    Tambah Brand
                </a>

                <a href="{{ route('admin.schedules.create') }}"
                    class="bg-[#20BDE3] text-white px-4 py-2 rounded-xl text-sm font-semibold">
                    <i class="bi bi-plus-lg"></i>
                    Tambah Sesi
                </a>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-cyan-100 flex items-center justify-center">
                    <i class="bi bi-building text-xl text-cyan-500"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Total Brand</p>
                    <h2 class="text-2xl font-semibold text-gray-900">{{ $brands->count() }}</h2>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-green-100 flex items-center justify-center">
                    <i class="bi bi-check-circle-fill text-xl text-green-500"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Brand Aktif</p>
                    <h2 class="text-2xl font-semibold text-gray-900">
                        {{ $brands->where('status', 'active')->count() }}
                    </h2>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center">
                    <i class="bi bi-calendar2-event text-xl text-blue-500"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Total Sesi</p>
                    <h2 class="text-2xl font-semibold text-gray-900">{{ $schedules->count() }}</h2>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[22px] border border-gray-100 shadow-sm p-5">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-900">Daftar Brand</h2>
            </div>

            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 text-left">
                        <th class="px-4 py-2.5 rounded-l-lg">Nama Brand</th>
                        <th class="px-4 py-2.5">Deskripsi</th>
                        <th class="px-4 py-2.5">Status</th>
                        <th class="px-4 py-2.5 rounded-r-lg text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($brands as $brand)
                        <tr class="border-b border-gray-100">
                            <td class="px-4 py-3">
                                <span class="px-3 py-1 rounded-lg bg-blue-100 text-blue-600 text-xs font-medium">
                                    {{ $brand->name }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-gray-500">
                                {{ $brand->description ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                @if($brand->status === 'active')
                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs">
                                        Aktif
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.brands.edit', $brand->id) }}"
                                        class="w-8 h-8 bg-blue-100 text-blue-500 rounded-lg flex items-center justify-center">
                                        <i class="bi bi-pencil-square text-sm"></i>
                                    </a>

                                    <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button onclick="return confirm('Yakin ingin menghapus brand ini?')"
                                            class="w-8 h-8 bg-red-500 text-white rounded-lg flex items-center justify-center">
                                            <i class="bi bi-trash text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-gray-400">
                                Belum ada brand
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="bg-white rounded-[22px] border border-gray-100 shadow-sm p-5">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-900">Daftar Sesi</h2>
            </div>

            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 text-left">
                        <th class="px-4 py-2.5 rounded-l-lg">Nama Sesi</th>
                        <th class="px-4 py-2.5">Brand</th>
                        <th class="px-4 py-2.5">Tanggal</th>
                        <th class="px-4 py-2.5">Jam</th>
                        <th class="px-4 py-2.5">Peserta</th>
                        <th class="px-4 py-2.5">Status</th>
                        <th class="px-4 py-2.5 rounded-r-lg text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($schedules as $schedule)
                        <tr class="border-b border-gray-100">
                            <td class="px-4 py-3 font-medium text-gray-800">
                                {{ $schedule->session_name }}
                            </td>

                            <td class="px-4 py-3">
                                <span class="px-3 py-1 rounded-lg bg-blue-100 text-blue-600 text-xs font-medium">
                                    {{ $schedule->brand->name ?? '-' }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-gray-500">
                                {{ \Carbon\Carbon::parse($schedule->session_date)->translatedFormat('d M Y') }}
                            </td>

                            <td class="px-4 py-3 text-gray-500">
                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                -
                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                            </td>

                            <td class="px-4 py-3">
                                <details>
                                    <summary class="cursor-pointer text-[#20BDE3] text-xs font-semibold">
                                        {{ $schedule->users->count() }} Peserta
                                    </summary>

                                    <div class="mt-3 space-y-2 min-w-[220px]">
                                        @forelse ($schedule->users as $participant)
                                            @php
                                                $attendance = $schedule->attendances
                                                    ->where('user_id', $participant->id)
                                                    ->first();

                                                if (!$attendance) {
                                                    $label = 'Belum Absen';
                                                    $class = 'bg-gray-100 text-gray-600';
                                                } elseif ($attendance->status === 'terlambat') {
                                                    $label = 'Terlambat';
                                                    $class = 'bg-orange-100 text-orange-700';
                                                } else {
                                                    $label = 'Hadir';
                                                    $class = 'bg-green-100 text-green-700';
                                                }
                                            @endphp

                                            <div class="flex items-center justify-between gap-3 rounded-xl bg-gray-50 px-3 py-2">
                                                <div class="flex items-center gap-2 min-w-0">
                                                    <div
                                                        class="w-7 h-7 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold">
                                                        {{ strtoupper(substr($participant->name, 0, 1)) }}
                                                    </div>

                                                    <span class="text-xs text-gray-700 truncate">
                                                        {{ $participant->name }}
                                                    </span>
                                                </div>

                                                <span class="px-2 py-1 rounded-full text-[10px] font-medium {{ $class }}">
                                                    {{ $label }}
                                                </span>
                                            </div>
                                        @empty
                                            <p class="text-xs text-gray-400">
                                                Belum ada peserta
                                            </p>
                                        @endforelse
                                    </div>
                                </details>
                            </td>

                            <td class="px-4 py-3">
                                @if($schedule->is_active)
                                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs">
                                        Aktif
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-500 text-xs">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.schedules.edit', $schedule->id) }}"
                                        class="w-8 h-8 bg-blue-100 text-blue-500 rounded-lg flex items-center justify-center">
                                        <i class="bi bi-pencil-square text-sm"></i>
                                    </a>

                                    <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button onclick="return confirm('Yakin ingin menghapus sesi ini?')"
                                            class="w-8 h-8 bg-red-500 text-white rounded-lg flex items-center justify-center">
                                            <i class="bi bi-trash text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-400">
                                Belum ada sesi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection