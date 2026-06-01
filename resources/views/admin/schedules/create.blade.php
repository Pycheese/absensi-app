@extends('admin.layouts.app')

@section('content')
    <div class="space-y-5">

        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Tambah Sesi</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Tambahkan jadwal sesi live shopping baru
                </p>
            </div>

            <a href="{{ route('admin.brand-session') }}"
                class="px-4 py-2 rounded-xl border border-gray-200 text-gray-600 text-sm font-semibold">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-100 text-red-700 px-5 py-4 rounded-2xl text-sm">
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-[22px] border border-gray-100 shadow-sm p-6 max-w-4xl">

            <form action="{{ route('admin.schedules.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Brand
                    </label>

                    <select name="brand_id"
                        class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 text-sm outline-none focus:border-[#20BDE3] focus:bg-white"
                        required>

                        <option value="">Pilih Brand</option>

                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Nama Sesi
                    </label>

                    <input type="text" name="session_name" value="{{ old('session_name') }}"
                        placeholder="Contoh: Live Flash Sale"
                        class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 text-sm outline-none focus:border-[#20BDE3] focus:bg-white"
                        required>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Tanggal Sesi
                    </label>

                    <input type="date" name="session_date" value="{{ old('session_date') }}"
                        class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 text-sm outline-none focus:border-[#20BDE3] focus:bg-white"
                        required>
                </div>

                <div class="grid grid-cols-2 gap-4">

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            Jam Mulai
                        </label>

                        <input type="time" name="start_time" value="{{ old('start_time') }}"
                            class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 text-sm outline-none focus:border-[#20BDE3] focus:bg-white"
                            required>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            Jam Selesai
                        </label>

                        <input type="time" name="end_time" value="{{ old('end_time') }}"
                            class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 text-sm outline-none focus:border-[#20BDE3] focus:bg-white"
                            required>
                    </div>

                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Lokasi
                    </label>

                    <input type="text" name="location" value="{{ old('location') }}" placeholder="Contoh: Studio Jakarta"
                        class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 text-sm outline-none focus:border-[#20BDE3] focus:bg-white"
                        required>
                </div>
                <div>
                    <label class="block mb-3 text-sm font-medium text-gray-700">
                        Peserta Sesi
                    </label>

                    <div class="border border-gray-200 rounded-xl p-4 bg-gray-50">
                        <div class="grid grid-cols-2 gap-3">

                            @foreach ($users as $user)
                                <label
                                    class="flex items-center gap-3 p-3 rounded-lg bg-white border border-gray-200 cursor-pointer hover:border-[#20BDE3]">

                                    <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" {{ in_array($user->id, old('user_ids', [])) ? 'checked' : '' }} class="w-4 h-4 text-[#20BDE3]">

                                    <div>
                                        <p class="text-sm font-medium text-gray-800">
                                            {{ $user->name }}
                                        </p>

                                        <p class="text-xs text-gray-400">
                                            {{ $user->email }}
                                        </p>
                                    </div>
                                </label>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Status
                    </label>

                    <select name="is_active"
                        class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 text-sm outline-none focus:border-[#20BDE3] focus:bg-white"
                        required>

                        <option value="">Pilih Status</option>

                        <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>
                            Tidak Aktif
                        </option>

                    </select>
                </div>

                <div class="flex gap-3 pt-2">

                    <a href="{{ route('admin.brand-session') }}"
                        class="px-5 py-3 rounded-xl border border-gray-200 text-gray-600 text-sm font-semibold">
                        Batal
                    </a>

                    <button type="submit"
                        class="bg-[#20BDE3] text-white px-6 py-3 rounded-xl text-sm font-semibold hover:bg-[#18aaca]">
                        Simpan Sesi
                    </button>

                </div>

            </form>

        </div>

    </div>
@endsection