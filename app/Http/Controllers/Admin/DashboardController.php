<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Payroll;
use App\Models\Schedule;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::whereIn('role', ['user', 'admin'])->count();

        $totalTodaySchedules = Schedule::whereDate('session_date', today())
            ->where('is_active', true)
            ->count();

        $presentToday = Attendance::whereDate('created_at', today())
            ->whereIn('status', ['hadir', 'selesai'])
            ->count();

        $lateToday = Attendance::whereDate('created_at', today())
            ->where('status', 'terlambat')
            ->count();

        $totalPossibleAttendance = $totalUsers * $totalTodaySchedules;

        $absentToday = max(
            $totalPossibleAttendance - ($presentToday + $lateToday),
            0
        );

        $unpaidPayroll = Payroll::where('status', 'unpaid')->count();

        $latestAttendances = Attendance::with([
            'user',
            'schedule.brand'
        ])
            ->latest()
            ->take(5)
            ->get();

        $totalAttendance = $presentToday + $lateToday + $absentToday;

        $presentPercent = $totalAttendance > 0
            ? round(($presentToday / $totalAttendance) * 100)
            : 0;

        $latePercent = $totalAttendance > 0
            ? round(($lateToday / $totalAttendance) * 100)
            : 0;

        $absentPercent = $totalAttendance > 0
            ? round(($absentToday / $totalAttendance) * 100)
            : 0;

        $employees = User::whereIn('role', ['user', 'admin'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'totalUsers',
            'totalTodaySchedules',
            'presentToday',
            'lateToday',
            'absentToday',
            'unpaidPayroll',
            'latestAttendances',
            'presentPercent',
            'latePercent',
            'absentPercent',
            'employees'
        ));
    }
}