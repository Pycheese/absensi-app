<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\AttendanceReportExport;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceReportController extends Controller
{
    public function index(Request $request)
    {
        $selectedDate = $request->filled('date')
            ? $request->date
            : today()->format('Y-m-d');

        $selectedStatus = $request->status;
        $selectedUser = $request->user_id;

        $users = User::where('role', 'user')
            ->orderBy('name')
            ->get();

        $schedules = Schedule::with([
            'brand',
            'users',
            'attendances.user'
        ])
            ->whereDate('session_date', $selectedDate)
            ->orderBy('start_time')
            ->get();

        $reportRows = collect();

        foreach ($schedules as $schedule) {
            $targetUsers = $selectedUser
                ? $schedule->users->where('id', $selectedUser)
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

                if ($selectedStatus && $selectedStatus !== $status) {
                    continue;
                }

                $reportRows->push((object) [
                    'user' => $user,
                    'schedule' => $schedule,
                    'attendance' => $attendance,
                    'status' => $status,
                    'status_label' => $statusLabel,
                ]);
            }
        }

        $presentToday = $reportRows->where('status', 'hadir')->count();
        $lateToday = $reportRows->where('status', 'terlambat')->count();
        $absentToday = $reportRows->where('status', 'tidak_hadir')->count();

        return view('admin.attendance-report.index', compact(
            'selectedDate',
            'selectedStatus',
            'selectedUser',
            'users',
            'reportRows',
            'presentToday',
            'lateToday',
            'absentToday'
        ));
    }
    public function exportExcel(Request $request)
    {
        $date = $request->date ?? today()->format('Y-m-d');

        return Excel::download(
            new AttendanceReportExport(
                $date,
                $request->status,
                $request->user_id
            ),
            'laporan-absensi-' . $date . '.xlsx'
        );
    }
}