<div class="bg-white rounded-2xl shadow-sm p-5">

    {{-- HEADER --}}
    <div class="mb-4">
        <h2 class="text-lg font-bold">
            {{ $schedule->session_name }}
        </h2>

        <p class="text-sm text-gray-500">
            {{ $schedule->start_time }} - {{ $schedule->end_time }}
            • {{ $schedule->location }}
        </p>
    </div>

    {{-- LIST KARYAWAN --}}
    <div class="space-y-2">

        @forelse($schedule->attendances as $attendance)

            <div class="flex justify-between items-center border-b pb-2">

                <span class="text-sm">
                    {{ $attendance->user->name }}
                </span>

                {{-- STATUS --}}
                @if($attendance->status == 'late')
                    <span class="text-xs bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full">
                        Terlambat
                    </span>
                @else
                    <span class="text-xs bg-green-100 text-green-600 px-3 py-1 rounded-full">
                        Hadir
                    </span>
                @endif

            </div>

        @empty
            <p class="text-sm text-gray-400">
                Belum ada absensi
            </p>
        @endforelse

    </div>

</div>