@extends('user.layouts.app')

@section('content')

    <div class="min-h-screen bg-[#34C3E3] max-w-md mx-auto relative pb-24 overflow-hidden">

        {{-- STATUS BAR --}}
        <div class="px-6 pt-3 text-black text-sm font-semibold">
            4.30
        </div>

        {{-- HEADER --}}
        <div class="px-6 pt-12 pb-8 text-white">

            <h1 class="text-4xl font-bold leading-tight">
                Upcoming <br>
                Schedule
            </h1>

            {{-- DATE SLIDER --}}
            <div class="flex gap-3 mt-10 overflow-x-auto no-scrollbar">

                {{-- ACTIVE --}}
                <div
                    class="min-w-[72px] h-[92px] rounded-2xl bg-white text-[#34C3E3] relative shadow-md flex flex-col items-center justify-center border border-[#1D447C]">

                    <div class="absolute top-0 right-0 w-4 h-4 bg-[#1D447C] rounded-full"></div>

                    <h2 class="text-5xl font-light leading-none">
                        01
                    </h2>

                    <p class="text-sm mt-2">
                        Mon
                    </p>

                </div>

                {{-- ITEM --}}
                <div
                    class="min-w-[72px] h-[92px] rounded-2xl bg-[#5FD0EA] text-white shadow-sm flex flex-col items-center justify-center border border-[#3DBDDA]">

                    <h2 class="text-5xl font-light leading-none">
                        02
                    </h2>

                    <p class="text-sm mt-2">
                        Tue
                    </p>

                </div>

                <div
                    class="min-w-[72px] h-[92px] rounded-2xl bg-[#5FD0EA] text-white shadow-sm flex flex-col items-center justify-center border border-[#3DBDDA]">

                    <h2 class="text-5xl font-light leading-none">
                        03
                    </h2>

                    <p class="text-sm mt-2">
                        Wed
                    </p>

                </div>

                <div
                    class="min-w-[72px] h-[92px] rounded-2xl bg-[#5FD0EA] text-white shadow-sm flex flex-col items-center justify-center border border-[#3DBDDA]">

                    <h2 class="text-5xl font-light leading-none">
                        04
                    </h2>

                    <p class="text-sm mt-2">
                        Thu
                    </p>

                </div>

            </div>

        </div>

        {{-- CONTENT --}}
        <div class="bg-[#F8F8F8] rounded-t-[40px] min-h-screen px-5 pt-8 pb-28">

            {{-- TITLE --}}
            <div class="flex justify-between items-center mb-8">

                <h2 class="text-2xl font-medium">
                    Schedule
                </h2>

                <select class="rounded-full border border-[#1D447C] text-xs px-3 py-1 bg-white shadow-sm outline-none">

                    <option>Today</option>
                    <option>Tomorrow</option>

                </select>

            </div>

            {{-- CARD --}}
            @foreach($schedules as $schedule)

                <div class="bg-white rounded-3xl shadow-md px-5 py-5 mb-6">

                    <h3 class="text-2xl font-normal mb-5">
                        {{ $schedule->session_name }}
                    </h3>

                    <div class="border-t border-gray-300 pt-4 flex justify-between">

                        <div class="flex-1">

                            <p class="text-gray-300 text-sm mb-1">
                                Time
                            </p>

                            <p class="text-lg">
                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H.i') }}
                                -
                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('H.i') }}
                                PM
                            </p>

                        </div>

                        <div class="w-px bg-gray-300 mx-5"></div>

                        <div class="flex-1">

                            <p class="text-gray-300 text-sm mb-1">
                                Duration
                            </p>

                            <p class="text-lg">
                                2 hours
                            </p>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

        {{-- BOTTOM NAV --}}
        <div class="fixed bottom-0 left-0 right-0 max-w-md mx-auto bg-white border-t border-gray-300 rounded-t-3xl">

            <div class="flex justify-around items-center py-4 text-black">

                <a href="{{ route('dashboard') }}">
                    <i class="bi bi-house text-2xl"></i>
                </a>

                <a href="{{ route('schedule.index') }}" class="text-[#34C3E3]">

                    <i class="bi bi-calendar3 text-2xl"></i>

                </a>

                <a href="{{ route('attendance.history') }}">
                    <i class="bi bi-bar-chart text-2xl"></i>
                </a>

                <a href="{{ route('profile.edit') }}">
                    <i class="bi bi-person text-2xl"></i>
                </a>

            </div>

        </div>

    </div>

@endsection