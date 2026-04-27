<!DOCTYPE html>
<html>

<head>
    <title>Attendance PDF</title>
</head>

<body>

    <h2>Attendance Report</h2>

    @foreach($attendances as $attendance)
        <p>{{ $attendance->user->name }}</p>
    @endforeach

</body>

</html>