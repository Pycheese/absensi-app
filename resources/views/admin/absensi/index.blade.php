<h1>ABSENSI HARI INI</h1>

@foreach($schedules as $schedule)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px">

        <h3>{{ $schedule->session_name }}</h3>

        @foreach($employees as $employee)

            @php
                $attendance = $attendances
                    ->where('user_id', $employee->id)
                    ->where('schedule_id', $schedule->id)
                    ->first();
            @endphp

            <div>
                {{ $employee->name }} -

                @if($attendance)
                    @if($attendance->status == 'late')
                        Terlambat
                    @else
                        Hadir
                    @endif
                @else
                    Belum Hadir
                @endif
            </div>

        @endforeach

    </div>
@endforeach


<hr>


<h1>REKAP LAPORAN</h1>

@foreach($employees as $employee)

    <div style="border:1px solid #ddd; padding:10px; margin-bottom:10px">
        <strong>{{ $employee->name }}</strong><br>

        Hadir: {{ $summary[$employee->id]['hadir'] }} <br>
        Terlambat: {{ $summary[$employee->id]['terlambat'] }} <br>
        Tidak Hadir: {{ $summary[$employee->id]['tidak_hadir'] }}
    </div>

@endforeach


<script>
    setInterval(() => {
        location.reload();
    }, 10000);
</script>