@extends('user.layouts.app')

@section('content')

    <div class="min-h-screen bg-[#2FC3E6] pb-24">

        {{-- HEADER --}}
        <div class="px-6 pt-14 pb-8 text-white">

            <div class="flex items-center gap-4">

                <a href="{{ route('schedule.index') }}" class="text-2xl">
                    <i class="bi bi-chevron-left"></i>
                </a>

                <h1 class="text-2xl font-semibold">
                    Choose Date
                </h1>

            </div>

        </div>

        {{-- CONTENT --}}
        <div class="bg-white rounded-t-[38px] min-h-screen px-6 pt-8">

            <h2 class="text-lg font-semibold text-gray-800 mb-6">
                {{ $selectedDate->translatedFormat('F Y') }}
            </h2>

            <div class="grid grid-cols-7 gap-y-6 text-center">

                @foreach (['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'] as $dayName)

                    <div class="text-[10px] text-gray-400 font-medium">
                        {{ $dayName }}
                    </div>

                @endforeach

                @foreach($calendarDays as $day)

                        @php
                            $isSelected = $selectedDate->isSameDay($day);
                        @endphp

                        <a href="{{ route('schedule.index', ['date' => $day->format('Y-m-d')]) }}" class="w-9 h-9 mx-auto rounded-full flex items-center justify-center text-sm transition
                                            {{ $isSelected
                    ? 'bg-[#2FC3E6] text-white'
                    : 'text-gray-700'
                                            }}">

                            {{ $day->format('d') }}

                        </a>

                @endforeach

            </div>

        </div>

    </div>

@endsection