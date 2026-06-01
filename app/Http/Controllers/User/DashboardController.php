<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Schedule;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $now = now();

        $todaySchedules = Schedule::with([
            'brand',
            'attendances' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }
        ])
            ->whereHas('users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })
            ->whereDate('session_date', today())
            ->where('is_active', true)
            ->orderBy('start_time')
            ->get()
            ->map(function ($schedule) use ($now) {
                [$scheduleStart, $scheduleEnd] = $this->getScheduleDateTime($schedule);

                $attendance = $schedule->attendances->first();

                $uiStatus = 'upcoming';
                $statusLabel = 'Belum Dapat Absen';
                $canCheckIn = false;
                $canCheckOut = false;

                if ($attendance && $attendance->check_in && $attendance->check_out) {
                    $uiStatus = 'completed';
                    $statusLabel = 'Selesai';
                } elseif ($attendance && $attendance->check_in && !$attendance->check_out) {
                    $uiStatus = 'checked_in';
                    $statusLabel = $attendance->status === 'terlambat' ? 'Terlambat' : 'Sudah Masuk';
                    $canCheckOut = $now->lte($scheduleEnd);
                } elseif ($now->lt($scheduleStart)) {
                    $uiStatus = 'upcoming';
                    $statusLabel = 'Belum Dapat Absen';
                } elseif ($now->between($scheduleStart, $scheduleEnd)) {
                    $uiStatus = 'ready';
                    $statusLabel = 'Belum Absen';
                    $canCheckIn = true;
                } else {
                    $uiStatus = 'expired';
                    $statusLabel = 'Tidak Hadir';
                }

                $schedule->ui_status = $uiStatus;
                $schedule->status_label = $statusLabel;
                $schedule->can_check_in = $canCheckIn;
                $schedule->can_check_out = $canCheckOut;
                $schedule->attendance = $attendance;
                $schedule->start_datetime = $scheduleStart;
                $schedule->end_datetime = $scheduleEnd;

                return $schedule;
            });

        $monthlyTotal = Schedule::whereMonth('session_date', today()->month)
            ->whereYear('session_date', today()->year)
            ->where('is_active', true)
            ->count();

        $monthlyPresent = Attendance::where('user_id', $user->id)
            ->whereMonth('created_at', today()->month)
            ->whereYear('created_at', today()->year)
            ->whereIn('status', ['hadir', 'terlambat', 'selesai'])
            ->count();

        $monthlyLate = Attendance::where('user_id', $user->id)
            ->whereMonth('created_at', today()->month)
            ->whereYear('created_at', today()->year)
            ->where('status', 'terlambat')
            ->count();

        $attendancePercent = $monthlyTotal > 0
            ? round(($monthlyPresent / $monthlyTotal) * 100)
            : 0;

        return view('user.dashboard.index', compact(
            'todaySchedules',
            'monthlyTotal',
            'monthlyPresent',
            'monthlyLate',
            'attendancePercent'
        ));
    }

    private function getScheduleDateTime(Schedule $schedule): array
    {
        $scheduleStart = Carbon::parse(
            $schedule->session_date->format('Y-m-d') . ' ' . $schedule->start_time
        );

        $scheduleEnd = Carbon::parse(
            $schedule->session_date->format('Y-m-d') . ' ' . $schedule->end_time
        );

        if ($scheduleEnd->lt($scheduleStart)) {
            $scheduleEnd->addDay();
        }

        return [$scheduleStart, $scheduleEnd];
    }
}