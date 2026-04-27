<!DOCTYPE html>
<html>

<head>
    <title>Attendance Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
        }
    </style>
</head>

<body>

    <h2>Laporan Attendance</h2>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Brand</th>
                <th>Session</th>
                <th>Waktu</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->user->name }}</td>
                    <td>{{ $attendance->schedule->brand_name }}</td>
                    <td>{{ $attendance->schedule->session_name }}</td>
                    <td>{{ $attendance->scan_time }}</td>
                    <td>{{ $attendance->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>