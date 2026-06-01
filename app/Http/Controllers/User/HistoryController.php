<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $selectedDate = $request->filled('date')
            ? Carbon::parse($request->date)
            : today();

        $schedules = Schedule::with([
            'brand',
            'attendances' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }
        ])
            ->whereHas('users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })
            ->where('is_active', true)
            ->whereDate('session_date', $selectedDate)
            ->orderBy('start_time')
            ->get()
            ->map(function ($schedule) {
                $attendance = $schedule->attendances->first();

                $schedule->attendance = $attendance;

                if (!$attendance) {
                    $schedule->history_status = 'tidak_hadir';
                    $schedule->history_label = 'Tidak Hadir';
                } elseif ($attendance->status === 'terlambat') {
                    $schedule->history_status = 'terlambat';
                    $schedule->history_label = 'Terlambat';
                } else {
                    $schedule->history_status = 'hadir';
                    $schedule->history_label = 'Hadir';
                }

                return $schedule;
            });

        if ($request->filled('status')) {
            $schedules = $schedules->filter(function ($schedule) use ($request) {
                return $schedule->history_status === $request->status;
            });
        }

        $presentCount = $schedules->where('history_status', 'hadir')->count();
        $lateCount = $schedules->where('history_status', 'terlambat')->count();
        $absentCount = $schedules->where('history_status', 'tidak_hadir')->count();

        $totalSchedule = $schedules->count();

        $attendancePercent = $totalSchedule > 0
            ? round((($presentCount + $lateCount) / $totalSchedule) * 100)
            : 0;

        return view('user.history.index', compact(
            'schedules',
            'selectedDate',
            'presentCount',
            'lateCount',
            'absentCount',
            'attendancePercent'
        ));
    }

    public function calendar()
    {
        $selectedDate = request('date')
            ? Carbon::parse(request('date'))
            : today();

        $startCalendar = today()->startOfMonth();
        $endCalendar = today()->copy()->addMonth()->endOfMonth();

        $calendarDays = collect();

        for ($date = $startCalendar->copy(); $date->lte($endCalendar); $date->addDay()) {
            $calendarDays->push($date->copy());
        }

        return view('user.history.calendar', compact(
            'calendarDays',
            'selectedDate'
        ));
    }
}