@extends('admin.layouts.app')

@section('content')
    <div class="space-y-5">

        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    Edit Profile
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Perbarui informasi akun admin
                </p>
            </div>

            <a href="{{ route('admin.profile.index') }}"
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

            <form method="POST" action="{{ route('admin.profile.update') }}" class="space-y-5">

                @csrf
                @method('PUT')

                <div class="flex items-center gap-4 pb-5 border-b border-gray-100">

                    <div
                        class="w-16 h-16 rounded-2xl bg-[#EAF8FC] text-[#20BDE3] flex items-center justify-center text-2xl font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div>
                        <h2 class="text-lg font-bold text-gray-900">
                            {{ auth()->user()->name }}
                        </h2>

                        <p class="text-sm text-gray-500">
                            {{ auth()->user()->email }}
                        </p>
                    </div>

                </div>

                <div class="grid md:grid-cols-2 gap-5">

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            Nama
                        </label>

                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                            class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 text-sm outline-none focus:border-[#20BDE3]"
                            required>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            Email
                        </label>

                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                            class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 text-sm outline-none focus:border-[#20BDE3]"
                            required>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            No. HP
                        </label>

                        <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                            placeholder="Masukkan nomor HP"
                            class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 text-sm outline-none focus:border-[#20BDE3]">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            Role
                        </label>

                        <input type="text" value="{{ ucfirst(auth()->user()->role) }}"
                            class="w-full border border-gray-200 bg-gray-100 rounded-xl px-4 py-3 text-sm" readonly>
                    </div>

                </div>

                <div class="flex gap-3 pt-2">

                    <a href="{{ route('admin.profile.index') }}"
                        class="px-5 py-3 rounded-xl border border-gray-200 text-gray-600 text-sm font-semibold">
                        Batal
                    </a>

                    <button type="submit"
                        class="bg-[#20BDE3] text-white px-6 py-3 rounded-xl text-sm font-semibold hover:bg-[#18aaca]">
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>
@endsection