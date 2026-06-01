@extends('admin.layouts.app')

@section('content')
    <div class="space-y-5">

        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Brand</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Perbarui informasi brand live shopping
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

        <div class="bg-white rounded-[22px] border border-gray-100 shadow-sm p-6 max-w-3xl">

            <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Nama Brand
                    </label>

                    <input type="text" name="name" value="{{ old('name', $brand->name) }}"
                        class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 text-sm outline-none focus:border-[#20BDE3] focus:bg-white"
                        required>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Deskripsi
                    </label>

                    <textarea name="description" rows="4"
                        class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 text-sm outline-none resize-none focus:border-[#20BDE3] focus:bg-white">{{ old('description', $brand->description) }}</textarea>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Status
                    </label>

                    <select name="status"
                        class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-3 text-sm outline-none focus:border-[#20BDE3] focus:bg-white"
                        required>
                        <option value="active" {{ old('status', $brand->status) == 'active' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="inactive" {{ old('status', $brand->status) == 'inactive' ? 'selected' : '' }}>
                            Nonaktif
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
                        Update Brand
                    </button>
                </div>
            </form>

        </div>

    </div>
@endsection