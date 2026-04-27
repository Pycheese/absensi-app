<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\QrCode;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class AttendanceController extends Controller
{
    public function store($token)
    {
        // 1. Cari QR berdasarkan token
        $qr = QrCode::where('token', $token)
            ->where('is_active', true)
            ->first();

        if (!$qr) {
            abort(404, 'QR tidak valid');
        }

        // 2. Cari schedule aktif berdasarkan QR
        $schedule = Schedule::where('qr_code_id', $qr->id)
            ->where('is_active', true)
            ->whereDate('session_date', today())
            ->first();

        if (!$schedule) {
            return redirect()->route('dashboard')
                ->with('error', 'Tidak ada session aktif untuk QR ini');
        }
        $now = now()->format('H:i:s');

        if ($now < $schedule->start_time || $now > $schedule->end_time) {
            return redirect()->route('dashboard')
                ->with('error', 'Attendance hanya bisa dilakukan sesuai jam session');
        }

        // 3. Cek apakah user sudah attendance untuk session ini
        $alreadyCheckedIn = Attendance::where('user_id', Auth::id())
            ->where('schedule_id', $schedule->id)
            ->exists();

        if ($alreadyCheckedIn) {
            return redirect()->route('dashboard')
                ->with('error', 'Kamu sudah check-in untuk session ini');
        }

        // 4. Simpan attendance
        Attendance::create([
            'user_id' => Auth::id(),
            'schedule_id' => $schedule->id,
            'qr_code_id' => $qr->id,
            'scan_time' => now(),
            'status' => 'check-in',
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Attendance berhasil disimpan');
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
        $attendances = Attendance::with(['schedule', 'user'])
            ->latest()
            ->get();

        return view('admin.dashboard', compact('attendances'));
    }
    public function exportPdf()
    {
        $attendances = Attendance::with(['user', 'schedule'])->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('attendance.pdf', compact('attendances'));

        return $pdf->download('attendance.pdf');
    }
}