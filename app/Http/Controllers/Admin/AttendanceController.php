<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\QrCode;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;


class AttendanceController extends Controller
{
    public function store($token)
    {
        $user = auth()->user();

        $qr = QrCode::where('token', $token)->firstOrFail();

        $schedule = Schedule::findOrFail($qr->schedule_id);

        // Cegah double attendance
        $alreadyAttendance = Attendance::where('user_id', $user->id)
            ->where('schedule_id', $schedule->id)
            ->first();

        if ($alreadyAttendance) {
            return back()->with('success', 'Kamu sudah absen');
        }

        // Ambil jam sekarang
        $now = now();

        // Gabungkan tanggal sesi + jam mulai
        $sessionStart = \Carbon\Carbon::parse(
            $schedule->session_date . ' ' . $schedule->start_time
        );

        // Tentukan status otomatis
        $status = now()->lessThanOrEqualTo($sessionStart)
            ? 'hadir'
            : 'terlambat';

        // Simpan attendance
        Attendance::create([
            'user_id' => $user->id,
            'schedule_id' => $schedule->id,
            'status' => $status,
        ]);

        return back()->with(
            'success',
            $status == 'late'
            ? 'Absensi berhasil, tetapi kamu terlambat'
            : 'Absensi berhasil'
        );
    }
    public function history()
    {
        $attendances = Attendance::with(['schedule'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('dashboard.history', compact('attendances'));
    }


    public function admin()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $attendances = Attendance::with(['user', 'schedule'])
            ->latest()
            ->get();

        $latestAttendances = Attendance::with(['user', 'schedule'])
            ->latest()
            ->take(5)
            ->get();

        $employees = \App\Models\User::latest()
            ->take(10)
            ->get();

        $totalUsers = \App\Models\User::count();

        $totalTodaySchedules = Schedule::whereDate(
            'session_date',
            today()
        )->count();

        $totalPresent = Attendance::whereDate(
            'created_at',
            today()
        )->count();

        $totalAbsent = max($totalUsers - $totalPresent, 0);

        $weeklyAttendances = Attendance::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->count();

        $weeklyPresent = Attendance::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->where('status', 'check-in')->count();

        $weeklyLate = Attendance::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->where('status', 'late')->count();

        $weeklyAbsent = max($totalUsers - ($weeklyPresent + $weeklyLate), 0);

        $presentPercent = $totalUsers > 0 ? round(($weeklyPresent / $totalUsers) * 100) : 0;
        $latePercent = $totalUsers > 0 ? round(($weeklyLate / $totalUsers) * 100) : 0;
        $absentPercent = $totalUsers > 0 ? round(($weeklyAbsent / $totalUsers) * 100) : 0;

        return view('admin.dashboard', compact(
            'attendances',
            'latestAttendances',
            'employees',
            'totalUsers',
            'totalTodaySchedules',
            'totalPresent',
            'totalAbsent',
            'presentPercent',
            'latePercent',
            'absentPercent',
            'weeklyPresent',
            'weeklyLate',
            'weeklyAbsent'
        ));
    }
    public function exportPdf()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $attendances = Attendance::with(['user', 'schedule'])->get();

        $pdf = Pdf::loadView('attendance.pdf', compact('attendances'));

        return $pdf->download('attendance.pdf');
    }
    public function report()
    {
        $today = today();

        // =========================
        // 1. Ambil semua schedule hari ini
        // =========================
        $schedules = Schedule::with([
            'brand',
            'attendances.user'
        ])->whereDate('session_date', today())->get();

        // =========================
        // 2. Ambil attendance hari ini
        // =========================
        $attendances = Attendance::with('user')
            ->whereDate('created_at', $today)
            ->get();

        // =========================
        // 3. Ambil semua karyawan
        // =========================
        $employees = User::where('role', 'user')->get();

        // =========================
        // 4. REKAP (STEP 7)
        // =========================
        $summary = [];

        foreach ($employees as $employee) {

            $userAttendances = Attendance::where('user_id', $employee->id);

            $hadir = (clone $userAttendances)
                ->where('status', 'check-in')
                ->count();

            $terlambat = (clone $userAttendances)
                ->where('status', 'late')
                ->count();

            $totalSchedule = Schedule::count();
            $totalAttendance = $userAttendances->count();

            $tidak_hadir = max($totalSchedule - $totalAttendance, 0);

            $summary[$employee->id] = [
                'hadir' => $hadir,
                'terlambat' => $terlambat,
                'tidak_hadir' => $tidak_hadir
            ];
        }

        // =========================
        // RETURN VIEW
        // =========================
        return view('admin.attendance.index', compact(
            'schedules',
            'attendances',
            'employees',
            'summary'
        ));
    }
}
