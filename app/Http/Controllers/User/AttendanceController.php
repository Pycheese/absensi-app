<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function checkIn(Schedule $schedule)
    {
        $user = Auth::user();
        $now = Carbon::now();

        if (!$schedule->is_active) {
            return back()->with('error', 'Sesi ini tidak aktif.');
        }

        [$startTime, $endTime] = $this->getScheduleDateTime($schedule);
        if (!$schedule->users()->where('users.id', $user->id)->exists()) {
            return back()->with('error', 'Kamu tidak terdaftar sebagai peserta sesi ini.');
        }

        if ($now->lt($startTime)) {
            return back()->with('error', 'Sesi belum dimulai.');
        }

        if ($now->gt($endTime)) {
            return back()->with('error', 'Sesi sudah berakhir.');
        }

        $attendance = Attendance::where('user_id', $user->id)
            ->where('schedule_id', $schedule->id)
            ->first();

        if ($attendance && $attendance->check_in) {
            return back()->with('error', 'Kamu sudah absen masuk untuk sesi ini.');
        }

        $status = $now->gt($startTime->copy()->addMinutes(15))
            ? 'terlambat'
            : 'hadir';

        Attendance::updateOrCreate(
            [
                'user_id' => $user->id,
                'schedule_id' => $schedule->id,
            ],
            [
                'check_in' => $now,
                'status' => $status,
            ]
        );

        return back()->with('success', 'Absen masuk berhasil.');
    }

    public function checkOut(Schedule $schedule)
    {
        $user = Auth::user();
        $now = Carbon::now();

        if (!$schedule->is_active) {
            return back()->with('error', 'Sesi ini tidak aktif.');
        }

        [$startTime, $endTime] = $this->getScheduleDateTime($schedule);
        if (!$schedule->users()->where('users.id', $user->id)->exists()) {
            return back()->with('error', 'Kamu tidak terdaftar sebagai peserta sesi ini.');
        }

        if ($now->lt($startTime)) {
            return back()->with('error', 'Sesi belum dimulai.');
        }

        if ($now->gt($endTime)) {
            return back()->with('error', 'Waktu absen keluar sudah berakhir.');
        }

        $attendance = Attendance::where('user_id', $user->id)
            ->where('schedule_id', $schedule->id)
            ->first();

        if (!$attendance || !$attendance->check_in) {
            return back()->with('error', 'Kamu belum absen masuk.');
        }

        if ($attendance->check_out) {
            return back()->with('error', 'Kamu sudah absen keluar.');
        }

        $attendance->update([
            'check_out' => $now,
            'status' => 'selesai',
        ]);

        return back()->with('success', 'Absen keluar berhasil.');
    }

    private function getScheduleDateTime(Schedule $schedule): array
    {
        $startTime = Carbon::parse(
            $schedule->session_date->format('Y-m-d') . ' ' . $schedule->start_time
        );

        $endTime = Carbon::parse(
            $schedule->session_date->format('Y-m-d') . ' ' . $schedule->end_time
        );

        if ($endTime->lt($startTime)) {
            $endTime->addDay();
        }

        return [$startTime, $endTime];
    }
}