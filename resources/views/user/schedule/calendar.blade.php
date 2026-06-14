@extends('user.layouts.app')

@section('content')
<div class="min-h-screen bg-[#2FC3E6]">

    {{-- Header --}}
    <div class="h-[120px] px-6 pt-10 flex items-center gap-5 text-white">
        <a href="{{ url()->previous() }}" class="text-3xl font-bold">
            ‹
        </a>

        <h1 class="text-[24px] font-bold">
            Choose Date
        </h1>
    </div>

    {{-- Card Calendar --}}
    <div class="bg-white min-h-[754px] rounded-t-[32px] px-6 pt-8 pb-24">

        {{-- Juni 2026 --}}
        <div class="mb-14">
            <h2 class="text-[#0B2A5B] text-[18px] font-semibold mb-6">
                Juni 2026
            </h2>

            <div class="grid grid-cols-7 text-center text-[10px] text-gray-400 mb-4">
                <div>MON</div>
                <div>TUE</div>
                <div>WED</div>
                <div>THU</div>
                <div>FRI</div>
                <div>SAT</div>
                <div>SUN</div>
            </div>

            <div class="grid grid-cols-7 text-center text-[#0B2A5B] text-[14px] gap-y-5">
                @php
                    $selectedDay = request('date') 
                        ? \Carbon\Carbon::parse(request('date'))->day 
                        : 1;

                    $days = [
                        1,2,3,4,5,6,7,
                        8,9,10,11,12,13,14,
                        15,16,17,18,19,20,21,
                        22,23,24,25,26,27,28,
                        29,30,31
                    ];
                @endphp

                @foreach ($days as $day)
                    <a href="{{ route('user.schedule.index', ['date' => '2026-06-' . str_pad($day, 2, '0', STR_PAD_LEFT)]) }}"
                       class="mx-auto flex h-6 w-6 items-center justify-center rounded-full
                       {{ $selectedDay == $day ? 'bg-[#2FC3E6] text-white' : 'text-[#0B2A5B]' }}">
                        {{ $day }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Juli 2026 --}}
        <div>
            <h2 class="text-[#0B2A5B] text-[18px] font-semibold mb-6">
                Juli 2026
            </h2>

            <div class="grid grid-cols-7 text-center text-[10px] text-gray-400 mb-4">
                <div>MON</div>
                <div>TUE</div>
                <div>WED</div>
                <div>THU</div>
                <div>FRI</div>
                <div>SAT</div>
                <div>SUN</div>
            </div>

            <div class="grid grid-cols-7 text-center text-[#0B2A5B] text-[14px] gap-y-5">
                @foreach (range(1, 31) as $day)
                    <a href="{{ route('user.schedule.index', ['date' => '2026-07-' . str_pad($day, 2, '0', STR_PAD_LEFT)]) }}"
                       class="mx-auto flex h-6 w-6 items-center justify-center rounded-full text-[#0B2A5B]">
                        {{ $day }}
                    </a>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection
