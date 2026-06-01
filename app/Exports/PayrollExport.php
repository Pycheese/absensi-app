<?php

namespace App\Exports;

use App\Models\Payroll;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PayrollExport implements FromCollection, WithHeadings
{
    protected $period;

    public function __construct($period)
    {
        $this->period = $period;
    }

    public function collection()
    {
        [$year, $month] = explode('-', $this->period);

        return Payroll::with('user')
            ->where('month', $month)
            ->where('year', $year)
            ->get()
            ->map(function ($payroll) {
                return [
                    'Nama' => $payroll->user->name,
                    'Email' => $payroll->user->email,
                    'Jabatan' => $payroll->position,
                    'Jenis' => ucfirst($payroll->type),
                    'Total Hadir' => $payroll->total_present,
                    'Gaji Harian' => $payroll->daily_salary,
                    'Bonus' => $payroll->bonus,
                    'Potongan' => $payroll->deduction,
                    'Total Gaji' => $payroll->total_salary,
                    'Tanggal Bayar' => $payroll->payment_date ?? '-',
                    'Status' => $payroll->status === 'paid' ? 'Lunas' : 'Belum Dibayar',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Email',
            'Jabatan',
            'Jenis',
            'Total Hadir',
            'Gaji Harian',
            'Bonus',
            'Potongan',
            'Total Gaji',
            'Tanggal Bayar',
            'Status',
        ];
    }
}