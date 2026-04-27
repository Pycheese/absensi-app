<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'user_id',
        'schedule_id',
        'qr_code_id',
        'scan_time',
        'status',
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function exportPdf()
    {
        $attendances = Attendance::with(['schedule', 'user'])
            ->latest()
            ->get();

        $pdf = Pdf::loadView('admin.pdf-report', compact('attendances'));

        return $pdf->download('attendance-report.pdf');
    }
}