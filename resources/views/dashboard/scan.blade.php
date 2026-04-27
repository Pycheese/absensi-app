@extends('layouts.app')

@section('content')

    <div class="p-5">

        <h1 class="text-2xl font-bold mb-4">
            QR Valid ✅
        </h1>

        <div class="bg-white rounded-2xl shadow p-5 border">

            <p class="text-gray-500">
                Location:
            </p>

            <h2 class="text-xl font-semibold mb-4">
                {{ $qr->location_name }}
            </h2>

            <a href="{{ route('attendance.store', $qr->token) }}"
                class="block text-center bg-blue-500 text-white py-3 rounded-xl">
                Check In Sekarang
            </a>

        </div>

    </div>

@endsection