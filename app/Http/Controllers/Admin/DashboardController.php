<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Payroll;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $totalUsers = User::where('role', 'user')->count();

        $totalTodaySchedules = Schedule::whereDate('session_date', $today)->count();

        $presentToday = Attendance::whereHas('schedule', function ($query) use ($today) {
            $query->whereDate('session_date', $today);
        })
            ->whereIn('status', ['hadir', 'selesai'])
            ->count();

        $lateToday = Attendance::whereHas('schedule', function ($query) use ($today) {
            $query->whereDate('session_date', $today);
        })
            ->where('status', 'terlambat')
            ->count();

        $absentToday = Attendance::whereHas('schedule', function ($query) use ($today) {
            $query->whereDate('session_date', $today);
        })
            ->where('status', 'belum_absen')
            ->count();

        $totalAttendanceToday = $presentToday + $lateToday + $absentToday;

        $presentPercent = $totalAttendanceToday > 0 ? round(($presentToday / $totalAttendanceToday) * 100) : 0;
        $latePercent = $totalAttendanceToday > 0 ? round(($lateToday / $totalAttendanceToday) * 100) : 0;
        $absentPercent = $totalAttendanceToday > 0 ? round(($absentToday / $totalAttendanceToday) * 100) : 0;

        $weeklyPresent = Attendance::whereHas('schedule', function ($query) {
            $query->whereBetween('session_date', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ]);
        })
            ->whereIn('status', ['hadir', 'selesai'])
            ->count();

        $weeklyLate = Attendance::whereHas('schedule', function ($query) {
            $query->whereBetween('session_date', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ]);
        })
            ->where('status', 'terlambat')
            ->count();

        $weeklyAbsent = Attendance::whereHas('schedule', function ($query) {
            $query->whereBetween('session_date', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ]);
        })
            ->where('status', 'belum_absen')
            ->count();

        $unpaidPayroll = Payroll::where('status', 'unpaid')->count();

        $latestAttendances = Attendance::with(['user', 'schedule.brand'])
            ->latest()
            ->take(5)
            ->get();

        $employees = User::where('role', 'user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalTodaySchedules',
            'presentToday',
            'lateToday',
            'absentToday',
            'presentPercent',
            'latePercent',
            'absentPercent',
            'weeklyPresent',
            'weeklyLate',
            'weeklyAbsent',
            'unpaidPayroll',
            'latestAttendances',
            'employees'
        ));
    }
}