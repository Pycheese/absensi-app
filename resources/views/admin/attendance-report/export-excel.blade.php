<table>
    <thead>
        <tr>
            <th>Karyawan</th>
            <th>Brand</th>
            <th>Sesi</th>
            <th>Waktu Sesi</th>
            <th>Absen Masuk</th>
            <th>Absen Keluar</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($reportRows as $row)
            <tr>
                <td>{{ $row->user->name }}</td>
                <td>{{ $row->schedule->brand->name ?? '-' }}</td>
                <td>{{ $row->schedule->session_name }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($row->schedule->start_time)->format('H:i') }}
                    -
                    {{ \Carbon\Carbon::parse($row->schedule->end_time)->format('H:i') }}
                </td>
                <td>{{ $row->attendance?->check_in?->format('H:i') ?? '-' }}</td>
                <td>{{ $row->attendance?->check_out?->format('H:i') ?? '-' }}</td>
                <td>{{ $row->status_label }}</td>
            </tr>
        @endforeach
    </tbody>
</table>