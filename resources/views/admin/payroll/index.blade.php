@extends('admin.layouts.app')

@section('content')
    <div class="space-y-6">

        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Penggajian</h1>
                <p class="text-gray-500 mt-1">
                    Kelola data penggajian karyawan dan admin setiap bulan
                </p>
            </div>

            <div class="flex gap-3">
                <form method="GET" action="{{ route('admin.payroll.index') }}">
                    <input type="month" name="period" value="{{ $period }}" onchange="this.form.submit()"
                        class="border rounded-xl px-4 py-3 bg-white">
                </form>

                <form method="POST" action="{{ route('admin.payroll.generate') }}">
                    @csrf
                    <input type="hidden" name="period" value="{{ $period }}">
                    <button class="bg-[#5CC6E7] text-white px-5 py-3 rounded-xl font-semibold">
                        Generate Gaji
                    </button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-5 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-4 gap-5">
            <div class="bg-white p-6 rounded-2xl shadow-sm border">
                <p class="text-gray-500">Total Karyawan & Admin</p>
                <h2 class="text-3xl font-bold mt-2">{{ $totalPeople }}</h2>
                <p class="text-gray-400 mt-1">Orang</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border">
                <p class="text-gray-500">Total Gaji Bulan Ini</p>
                <h2 class="text-3xl font-bold mt-2">
                    Rp {{ number_format($totalSalary, 0, ',', '.') }}
                </h2>
                <p class="text-gray-400 mt-1">Periode {{ $period }}</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border">
                <p class="text-gray-500">Sudah Dibayar</p>
                <h2 class="text-3xl font-bold mt-2">{{ $paid }}</h2>
                <p class="text-gray-400 mt-1">Orang</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border">
                <p class="text-gray-500">Belum Dibayar</p>
                <h2 class="text-3xl font-bold mt-2">{{ $unpaid }}</h2>
                <p class="text-gray-400 mt-1">Orang</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 overflow-hidden">

            <div class="flex items-center justify-between mb-5">
                <h2 class="text-xl font-bold text-gray-900">Daftar Penggajian</h2>

                <a href="{{ route('admin.payroll.export', ['period' => $period]) }}"
                    class="px-4 py-2 rounded-xl border border-green-500 text-green-600 text-sm font-semibold hover:bg-green-50">
                    Export Excel
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">

                    <thead>
                        <tr class="bg-gray-50 text-gray-600">
                            <th class="px-4 py-4 text-left rounded-l-xl">No</th>
                            <th class="px-4 py-4 text-left">Nama</th>
                            <th class="px-4 py-4 text-left">Posisi</th>
                            <th class="px-4 py-4 text-left">Jabatan</th>
                            <th class="px-4 py-4 text-left">Total Gaji</th>
                            <th class="px-4 py-4 text-left">Tanggal Bayar</th>
                            <th class="px-4 py-4 text-left">Status</th>
                            <th class="px-4 py-4 text-left rounded-r-xl">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @foreach($payrolls as $payroll)

                            <tr class="hover:bg-gray-50">

                                <td class="px-4 py-4 whitespace-nowrap">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">

                                        <div
                                            class="w-9 h-9 rounded-full bg-[#5CC6E7] text-white flex items-center justify-center font-bold">

                                            {{ strtoupper(substr($payroll->user->name, 0, 1)) }}

                                        </div>

                                        <span>
                                            {{ $payroll->user->name }}
                                        </span>

                                    </div>
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap">
                                    {{ $payroll->position }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap">

                                    @if($payroll->type === 'admin')

                                        <span class="px-3 py-1 rounded-lg text-xs bg-purple-100 text-purple-600">
                                            Admin
                                        </span>

                                    @else

                                        <span class="px-3 py-1 rounded-lg text-xs bg-blue-100 text-blue-600">
                                            Karyawan
                                        </span>

                                    @endif

                                </td>

                                <td class="px-4 py-4 whitespace-nowrap font-bold">
                                    Rp {{ number_format($payroll->total_salary, 0, ',', '.') }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap">
                                    {{ $payroll->payment_date ?? '-' }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap">

                                    @if($payroll->status === 'paid')

                                        <span class="px-3 py-1 rounded-lg text-xs bg-green-100 text-green-700">
                                            Lunas
                                        </span>

                                    @else

                                        <span class="px-3 py-1 rounded-lg text-xs bg-orange-100 text-orange-600">
                                            Belum Dibayar
                                        </span>

                                    @endif

                                </td>

                                <td class="px-4 py-4 whitespace-nowrap">

                                    @if($payroll->status === 'unpaid')

                                        <form method="POST" action="{{ route('admin.payroll.paid', $payroll->id) }}">

                                            @csrf

                                            <button class="px-3 py-2 rounded-lg bg-green-100 text-green-700 text-xs font-semibold">

                                                Bayar

                                            </button>

                                        </form>

                                    @else

                                        <span class="px-3 py-2 rounded-lg bg-gray-100 text-gray-500 text-xs">
                                            Selesai
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>

        <div class="bg-blue-50 border border-blue-100 text-gray-700 rounded-xl px-5 py-4">
            <i class="bi bi-info-circle text-blue-500"></i>
            Data gaji dihitung berdasarkan periode yang dipilih. Pastikan data absensi sudah lengkap.
        </div>

    </div>
@endsection