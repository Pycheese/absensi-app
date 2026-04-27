@extends('layouts.app')

@section('content')

    <div class="p-5">

        <h1 class="text-2xl font-bold mb-5">
            Attendance History
        </h1>

        @forelse($attendances as $attendance)
            <div class="bg-white rounded-2xl shadow p-4 mb-4 border">

                <h2 class="font-semibold text-lg">
                    {{ $attendance->schedule->brand_name }}
                </h2>

                <p class="text-gray-500">
                    {{ $attendance->schedule->session_name }}
                </p>

                <p class="text-sm text-gray-400 mt-2">
                    {{ $attendance->scan_time }}
                </p>

                <p class="text-green-600 font-semibold mt-2">
                    {{ ucfirst($attendance->status) }}
                </p>

            </div>
        @empty
            <p class="text-gray-500">
                Belum ada riwayat attendance
            </p>
        @endforelse

    </div>

    <x-bottom-nav />

@endsection