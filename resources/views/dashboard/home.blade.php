@extends('layouts.app')

@section('content')

    <div class="p-5 pb-24">

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold">
                Hi, User 👋
            </h1>
            <p class="text-gray-500">
                Welcome back to Attendance App
            </p>
        </div>

        <!-- Attendance Card -->
        <div class="bg-white rounded-2xl shadow p-5 mb-5 border">
            <h2 class="font-semibold text-lg mb-2">
                Today's Attendance
            </h2>

            <p class="text-gray-500">
                Check-in status:
            </p>

            <p class="text-green-600 font-bold text-xl">
                Present
            </p>
        </div>

        <!-- Quick Menu -->
        <div class="grid grid-cols-2 gap-4">

            <a href="/schedule" class="bg-blue-50 rounded-2xl p-4 shadow-sm">
                <h3 class="font-semibold">
                    Schedule
                </h3>
                <p class="text-sm text-gray-500">
                    View your work schedule
                </p>
            </a>

            <a href="/profile" class="bg-purple-50 rounded-2xl p-4 shadow-sm">
                <h3 class="font-semibold">
                    Profile
                </h3>
                <p class="text-sm text-gray-500">
                    Manage your account
                </p>
            </a>
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded-xl mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded-xl mb-4">
                    {{ session('error') }}
                </div>
            @endif

        </div>

    </div>

    <x-bottom-nav />

@endsection