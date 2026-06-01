@extends('admin.layouts.app')

@section('content')
    @php
        $user = auth()->user();
        $initial = strtoupper(substr($user->name, 0, 1));
    @endphp

    <div class="space-y-5">

        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Profile</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola informasi akun admin</p>
            </div>

            <a href="{{ route('admin.dashboard') }}"
                class="px-4 py-2 rounded-xl border border-gray-200 text-gray-600 text-sm font-semibold">
                <i class="bi bi-arrow-left"></i>
                Dashboard
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-50 border border-green-100 text-green-700 px-5 py-4 rounded-2xl text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-[22px] border border-gray-100 shadow-sm p-6 max-w-4xl">

            <div class="flex items-center gap-5 border-b border-gray-100 pb-6 mb-6">
                <div
                    class="w-20 h-20 rounded-2xl bg-[#EAF8FC] text-[#20BDE3] flex items-center justify-center text-3xl font-bold">
                    {{ $initial }}
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        {{ $user->name }}
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ $user->email }}
                    </p>

                    <span class="inline-flex mt-3 px-3 py-1 rounded-full bg-purple-100 text-purple-700 text-xs font-medium">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-5">

                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-4">
                    <p class="text-xs text-gray-500 mb-1">Nama</p>
                    <p class="text-sm font-semibold text-gray-900">
                        {{ $user->name }}
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-4">
                    <p class="text-xs text-gray-500 mb-1">Email</p>
                    <p class="text-sm font-semibold text-gray-900">
                        {{ $user->email }}
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-4">
                    <p class="text-xs text-gray-500 mb-1">No. HP</p>
                    <p class="text-sm font-semibold text-gray-900">
                        {{ $user->phone ?? '-' }}
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-4">
                    <p class="text-xs text-gray-500 mb-1">Role</p>
                    <p class="text-sm font-semibold text-gray-900">
                        {{ ucfirst($user->role) }}
                    </p>
                </div>

            </div>

            <div class="flex gap-3 mt-6">

                <a href="{{ route('admin.profile.edit') }}"
                    class="px-5 py-3 rounded-xl border border-gray-200 text-[#20BDE3] text-sm font-semibold">
                    <i class="bi bi-pencil-square"></i>
                    Edit Profile
                </a>

                <a href="{{ route('admin.profile.password') }}"
                    class="px-5 py-3 rounded-xl bg-[#20BDE3] text-white text-sm font-semibold hover:bg-[#18aaca]">
                    <i class="bi bi-lock"></i>
                    Ganti Password
                </a>

            </div>

        </div>

    </div>
@endsection