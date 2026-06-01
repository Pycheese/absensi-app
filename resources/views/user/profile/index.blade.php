@extends('user.layouts.app')

@section('content')

    <div class="min-h-screen bg-[#2FC3E6] relative pb-24 overflow-hidden">

        {{-- BACK --}}
        <div class="px-8 pt-8">
            <a href="{{ route('dashboard') }}" class="text-black text-4xl leading-none">
                <i class="bi bi-chevron-left"></i>
            </a>
        </div>

        {{-- AVATAR --}}
        <div class="relative z-20 flex justify-center mt-16">
            <div
                class="w-28 h-28 rounded-full bg-[#E8ECFF] flex items-center justify-center overflow-hidden border-[6px] border-[#2FC3E6]">
                <i class="bi bi-person-fill text-[92px] text-[#3F86F6] translate-y-4"></i>
            </div>
        </div>

        {{-- WHITE CONTENT --}}
        <div class="bg-white rounded-t-[40px] min-h-[560px] -mt-11 px-6 pt-16 pb-28">

            {{-- USER INFO --}}
            <div class="text-center">
                <h1 class="text-4xl font-semibold text-black leading-tight">
                    {{ auth()->user()->name }}
                </h1>

                <p class="text-lg text-black/80 mt-1">
                    {{ auth()->user()->email }}
                </p>
            </div>

            <div class="border-t border-gray-300 mt-5 mb-8"></div>

            {{-- MENU --}}
            <div class="space-y-4">

                <a href="#" class="h-16 border border-gray-400 rounded-lg flex items-center justify-between px-5 bg-white">

                    <div class="flex items-center gap-5">
                        <i class="bi bi-gear text-2xl"></i>
                        <span class="text-lg text-gray-800">Pengaturan</span>
                    </div>

                    <i class="bi bi-chevron-right text-3xl text-black"></i>
                </a>

                <a href="#" class="h-16 border border-gray-400 rounded-lg flex items-center justify-between px-5 bg-white">

                    <div class="flex items-center gap-5">
                        <i class="bi bi-lock text-2xl"></i>
                        <span class="text-lg text-gray-800">Keamanan</span>
                    </div>

                    <i class="bi bi-chevron-right text-3xl text-black"></i>
                </a>

                <a href="#" class="h-16 border border-gray-400 rounded-lg flex items-center justify-between px-5 bg-white">

                    <div class="flex items-center gap-5">
                        <i class="bi bi-question-circle text-2xl"></i>
                        <span class="text-lg text-gray-800">Bantuan & Dukungan</span>
                    </div>

                    <i class="bi bi-chevron-right text-3xl text-black"></i>
                </a>

            </div>

            {{-- LOGOUT --}}
            <form method="POST" action="{{ route('logout') }}" class="mt-20">
                @csrf

                <button type="submit"
                    class="w-full h-16 border border-gray-400 rounded-lg flex items-center justify-between px-5 bg-white text-red-500">

                    <div class="flex items-center gap-5">
                        <i class="bi bi-box-arrow-right text-2xl"></i>
                        <span class="text-lg">Keluar</span>
                    </div>

                    <i class="bi bi-chevron-right text-3xl"></i>
                </button>
            </form>

        </div>

    </div>

@endsection