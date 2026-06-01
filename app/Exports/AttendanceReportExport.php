<?php

namespace App\Exports;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AttendanceReportExport implements FromView
{
    protected $date;
    protected $status;
    protected $userId;

    public function __construct($date, $status = null, $userId = null)
    {
        $this->date = $date;
        $this->status = $status;
        $this->userId = $userId;
    }

    public function view(): View
    {
        $users = User::orderBy('name')->get();

        $schedules = Schedule::with([
            'brand',
            'users',
            'attendances.user'
        ])
            ->whereDate('session_date', $this->date)
            ->orderBy('start_time')
            ->get();

        $reportRows = collect();

        foreach ($schedules as $schedule) {
            $targetUsers = $this->userId
                ? $schedule->users->where('id', $this->userId)
                : $schedule->users;

            foreach ($targetUsers as $user) {
                $attendance = $schedule->attendances
                    ->where('user_id', $user->id)
                    ->first();

                if (!$attendance) {
                    $status = 'tidak_hadir';
                    $statusLabel = 'Tidak Hadir';
                } elseif ($attendance->status === 'terlambat') {
                    $status = 'terlambat';
                    $statusLabel = 'Terlambat';
                } else {
                    $status = 'hadir';
                    $statusLabel = 'Hadir';
                }

                if ($this->status && $this->status !== $status) {
                    continue;
                }

                $reportRows->push((object) [
                    'user' => $user,
                    'schedule' => $schedule,
                    'attendance' => $attendance,
                    'status_label' => $statusLabel,
                ]);
            }
        }

        return view('admin.attendance-report.export-excel', compact('reportRows'));
    }
}