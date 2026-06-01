@extends('admin.layouts.app')

@section('content')

    <div class="flex w-full min-h-screen bg-[#F5F5F5]">

        {{-- SIDEBAR --}}
        <aside class="w-[260px] bg-[#5CC6E7] text-white p-6">
            Sidebar
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 p-8">
            <h1 class="text-3xl font-bold mb-6">
                Absensi & Laporan
            </h1>
        </main>

    </div>

@endsection