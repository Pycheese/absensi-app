@extends('admin.layouts.app')

@section('content')
    <div class="space-y-5">

        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Karyawan</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Kelola data karyawan perusahaan
                </p>
            </div>

            <a href="{{ route('admin.employees.create') }}"
                class="bg-[#20BDE3] text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-[#18aaca] transition">
                <i class="bi bi-plus-lg"></i>
                Tambah Karyawan
            </a>
        </div>

        <div class="grid grid-cols-3 gap-4">

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center">
                    <i class="bi bi-people-fill text-xl text-blue-500"></i>
                </div>

                <div>
                    <p class="text-xs text-gray-500">
                        Total Karyawan
                    </p>

                    <h2 class="text-2xl font-semibold text-gray-900">
                        {{ $employees->count() }}
                    </h2>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-green-100 flex items-center justify-center">
                    <i class="bi bi-check-circle-fill text-xl text-green-500"></i>
                </div>

                <div>
                    <p class="text-xs text-gray-500">
                        Admin
                    </p>

                    <h2 class="text-2xl font-semibold text-gray-900">
                        {{ $employees->where('role', 'admin')->count() }}
                    </h2>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-cyan-100 flex items-center justify-center">
                    <i class="bi bi-person-badge-fill text-xl text-cyan-500"></i>
                </div>

                <div>
                    <p class="text-xs text-gray-500">
                        Karyawan
                    </p>

                    <h2 class="text-2xl font-semibold text-gray-900">
                        {{ $employees->where('role', 'user')->count() }}
                    </h2>
                </div>
            </div>

        </div>

        <div class="bg-white rounded-[22px] border border-gray-100 shadow-sm p-5">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-900">
                    Daftar Karyawan
                </h2>
            </div>

            <div class="overflow-hidden border border-gray-100 rounded-2xl">

                <table class="w-full text-sm">

                    <thead class="bg-gray-50">
                        <tr class="text-left text-gray-600">
                            <th class="px-4 py-2.5">Foto</th>
                            <th class="px-4 py-2.5">Nama</th>
                            <th class="px-4 py-2.5">Email</th>
                            <th class="px-4 py-2.5">Role</th>
                            <th class="px-4 py-2.5 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($employees as $employee)

                            <tr class="border-t border-gray-100">

                                <td class="px-4 py-3">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">

                                        <i class="bi bi-person-fill text-lg text-blue-500"></i>

                                    </div>
                                </td>

                                <td class="px-4 py-3 font-medium text-gray-800">
                                    {{ $employee->name }}
                                </td>

                                <td class="px-4 py-3 text-gray-500">
                                    {{ $employee->email }}
                                </td>

                                <td class="px-4 py-3">

                                    @if ($employee->role === 'admin')

                                        <span class="px-3 py-1 rounded-full bg-purple-100 text-purple-700 text-xs font-medium">

                                            Admin

                                        </span>

                                    @else

                                        <span class="px-3 py-1 rounded-full bg-cyan-100 text-cyan-700 text-xs font-medium">

                                            Karyawan

                                        </span>

                                    @endif

                                </td>

                                <td class="px-4 py-3">

                                    <div class="flex justify-center gap-2">

                                        <a href="{{ route('admin.employees.edit', $employee->id) }}"
                                            class="w-8 h-8 bg-blue-100 text-blue-500 rounded-lg flex items-center justify-center">

                                            <i class="bi bi-pencil-square text-sm"></i>

                                        </a>

                                        <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button onclick="return confirm('Yakin ingin menghapus karyawan ini?')"
                                                class="w-8 h-8 bg-red-500 text-white rounded-lg flex items-center justify-center">

                                                <i class="bi bi-trash text-sm"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-400">
                                    Belum ada data karyawan
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
@endsection