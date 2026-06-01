<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PayrollExport;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Payroll;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PayrollController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->period ?? now()->format('Y-m');

        [$year, $month] = explode('-', $period);

        $payrolls = Payroll::with('user')
            ->where('month', $month)
            ->where('year', $year)
            ->latest()
            ->get();

        $totalPeople = $payrolls->count();
        $totalSalary = $payrolls->sum('total_salary');
        $paid = $payrolls->where('status', 'paid')->count();
        $unpaid = $payrolls->where('status', 'unpaid')->count();

        return view('admin.payroll.index', compact(
            'payrolls',
            'period',
            'totalPeople',
            'totalSalary',
            'paid',
            'unpaid'
        ));
    }

    public function generate(Request $request)
    {
        $period = $request->period ?? now()->format('Y-m');

        [$year, $month] = explode('-', $period);

        $users = User::whereIn('role', ['user', 'admin'])->get();

        foreach ($users as $user) {
            $totalPresent = Attendance::where('user_id', $user->id)
                ->whereHas('schedule.users', function ($query) use ($user) {
                    $query->where('users.id', $user->id);
                })
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->whereIn('status', ['hadir', 'terlambat', 'selesai'])
                ->count();

            $totalLate = Attendance::where('user_id', $user->id)
                ->whereHas('schedule.users', function ($query) use ($user) {
                    $query->where('users.id', $user->id);
                })
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->where('status', 'terlambat')
                ->count();

            $deduction = $totalLate * 10000;

            $type = $user->role === 'admin' ? 'admin' : 'karyawan';

            $dailySalary = $type === 'admin' ? 150000 : 100000;

            $grossSalary = $totalPresent * $dailySalary;

            $totalSalary = $grossSalary - $deduction;

            Payroll::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'month' => $month,
                    'year' => $year,
                ],
                [
                    'position' => $type === 'admin' ? 'Admin' : 'Host Live',
                    'type' => $type,
                    'total_present' => $totalPresent,
                    'daily_salary' => $dailySalary,
                    'bonus' => 0,
                    'deduction' => $deduction,
                    'total_salary' => $totalSalary,
                    'status' => 'unpaid',
                ]
            );
        }

        return redirect()
            ->route('admin.payroll.index', ['period' => $period])
            ->with('success', 'Data penggajian berhasil dibuat.');
    }

    public function markAsPaid($id)
    {
        $payroll = Payroll::findOrFail($id);

        $payroll->update([
            'status' => 'paid',
            'payment_date' => now()->toDateString(),
        ]);

        return back()->with('success', 'Status pembayaran berhasil diubah.');
    }

    public function export(Request $request)
    {
        $period = $request->period ?? now()->format('Y-m');

        return Excel::download(
            new PayrollExport($period),
            'laporan-penggajian-' . $period . '.xlsx'
        );
    }
}