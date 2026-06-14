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
    $months = [$firstMonth, $secondMonth];
@endphp

@foreach ($months as $month)
    <div class="mb-14">
        <h2 class="text-[#0B2A5B] text-[18px] font-semibold mb-6">
            {{ $month->translatedFormat('F Y') }}
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
            @for ($day = 1; $day <= $month->daysInMonth; $day++)
                @php
                    $date = $month->copy()->day($day);
                    $isSelected = $date->isSameDay($selectedDate);
                @endphp

                <a href="{{ route('user.schedule.index', ['date' => $date->format('Y-m-d')]) }}"
                   class="mx-auto flex h-7 w-7 items-center justify-center rounded-full
                   {{ $isSelected ? 'bg-[#2FC3E6] text-white' : 'text-[#0B2A5B]' }}">
                    {{ $day }}
                </a>
            @endfor
        </div>
    </div>
@endforeach
